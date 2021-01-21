<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class TahfidzTaskController extends Controller
{
    public function manageTask()
    {
        $response = Http::post(config('base_tahfidz_url') . 'submission/api_get_submission_master.php', []);

        $dayta = json_decode($response);
        $dayta = $dayta->submission;
        // dd($dayta);
        return view('mentor.tahfidz-task.manage')->with('dayta', $dayta);
    }

    public function viewStudent()
    {
        $id =  Auth::guard('student')->user()->id;
        $response = Http::get(config('base_tahfidz_url') . 'submission/api_get_submission_master.php', [
            "student_id" => Auth::guard('student')->user()->id,
        ]);

        $dayta = json_decode($response);
        $dayta = $dayta->submission;
        return view('student.manage_task')->with('dayta', $dayta);
    }

    public function viewCreate()
    {
        $id =  Auth::guard('student')->user()->id;
        $student = Student::findOrFail($id);
        return view('student.create_tahfidz_task')->with(compact('student'));
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function simpan(Request $request)
    {
        $urlAPI = config('base_tahfidz_url') . "submission/upload_submission.php";

        $rules = [
            'surat_mulai'     => 'required',
            'ayat_mulai'     => 'required',
            'surat_selesai'     => 'required',
            'ayat_selesai'     => 'required',
            'student_id'     => 'required',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];

        $required = array('studentName', 'studentID', 'group', 'start', 'end', 'type');

        //Be Aware with ":", it will be used on API, dont change these 2 lines to "-" or other forms of variable
        $start = $request->surat_mulai . ":" . $request->ayat_mulai;
        $end = $request->surat_selesai . ":" . $request->ayat_selesai;

        $studentID = Auth::guard('student')->user()->id;
        $studentName = Auth::guard('student')->user()->name;

        if ($request->hasFile('file_audio')) {
            $this->validate($request, $rules, $customMessages);
            $extension = $request->file('file_audio')->extension();

            $response = Http::attach(
                'inputSubmission',
                file_get_contents($request->file_audio),
                now() . $studentID . $extension
            )->post($urlAPI, [
                "studentName" => $studentName,
                "studentID" => $studentID,
                "group" => "-",
                "start" => $start,
                "end" => $end,
                "type" => $request->type,
            ]);
            $response = json_decode($response);
            if ($response->response_code == 1) {
                $this->sendNotification("Setoran Baru","$studentName Mengirimkan Setoran Hafalan Baru");
                return redirect("student/task")->with(['success' => "Berhasil Upload Setoran"]);
            } else {
                return redirect("student/task")->with(['error' => "Gagal Mengupload Setoran"]);
            }
        } else {
            return redirect("student/task")->with(['error' => "Pilih File Terlebih Dahulu"]);
        }
    }


    /**
     * hapus setoran
     *
     * @return void
     */
    public function deleteByStudent($id)
    {
        // list of submission that belongs to student teached by this teacher
        $response = Http::get(config('base_tahfidz_url') . '/submission/delete_submission.php', [
            'submission_id' => $id,
        ]);
        $dayta = json_decode($response);
        $status = false;
        if ($dayta->response_code != 1) {
            $dayta = array();
            $status = false;
        } else {
            $status = true;
        }
        if ($status) {
            return redirect("student/task")->with(['success' => 'Setoran Berhasil Dihapus']);
        } else {
            return redirect("student/task")->with(['error' => 'Setoran Gagal Dihapus']);
        }
    }


    public function sendNotification($title,$body){

        $notificationBuilder = new PayloadNotificationBuilder("$title");
        $notificationBuilder->setBody("$body")
                            ->setSound('defaut');

        $notification = $notificationBuilder->build();

        $topic = new Topics();
        $topic->topic('all');

        $topicResponse = FCM::sendToTopic($topic, null, $notification, null);

        $topicResponse->isSuccess();
        $topicResponse->shouldRetry();
        $topicResponse->error();
    }
}
