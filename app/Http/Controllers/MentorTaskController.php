<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\TahfidzTask;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use LaravelFCM\Facades\FCM;
use LaravelFCM\Message\PayloadNotificationBuilder;
use LaravelFCM\Message\Topics;

class MentorTaskController extends Controller
{
    /**
     * update data show all task from all student
     *
     * @return void
     */
    public function manage()
    {
        $groupName = "Daftar Semua Siswa";
        $mentor_id =  Auth::guard('mentor')->user()->id;
        $group = null;

        $response =
            Http::get(config('base_tahfidz_url') . '/submission/api_get_submission_master.php', [
                'mentor_id' => $mentor_id,
            ]);

        $responseGroup =
            Http::get(config('base_tahfidz_url') . '/group/grouping_mentor_info.php', [
                'mentor_id' => $mentor_id,
            ]);

        $groupData = json_decode($responseGroup);
        
        if ($groupData->response_code != 1) {
            $groupData = array();
        } else {
            $groupData = $groupData->group;
        }

        $dayta = json_decode($response);
        if ($dayta->response_code != 1) {
            $dayta = array();
        } else {
            $dayta = $dayta->submission;
        }
        return view('mentor.tahfidz-task.manage')->with(compact('groupData', 'dayta', 'groupName'));
    }

        /**
     * update data show all task from all student
     *
     * @return void
     */
    public function getStudent()
    {
        $mentor_id =  Auth::guard('mentor')->user()->id;

        $response =  DB::table('group_data_for_student')
        ->where('mentor_id','=',$mentor_id)
        ->get();

        $dayta=$response;
        if (empty($dayta)) {
            $dayta = array();
        }
        return view('mentor.tahfidz-task.group')->with(compact('dayta'));
    }

    /**
     * score selected task from table in order for scoring
     *
     * @return void
     */
    public function edit($id)  //view
    {

        $data = Http::get(config('base_tahfidz_url') . '/submission/api_get_submission_master.php', [
            'id' => $id,
        ]);
        $dayta = json_decode($data);
        if ($dayta->response_code != 1) {
            $dayta = array();
        } else {
            $dayta = $dayta->submission;
            $dayta = $dayta[0];
        }
        return view('mentor.tahfidz-task.scoring')->with(compact('dayta'));
    }

    /**
     * show tahfidz task data based on group
     *
     * @return void
     */
    public function taskByGroup($id)
    {
        $modelGroup = Group::findOrFail($id);
        $groupName = $modelGroup->name;
        $mentor_id =  Auth::guard('mentor')->user()->id;
        $group = null;
        $className = null;

        // list of submission that belongs to student teached by this teacher
        $response = Http::get(config('base_tahfidz_url') . '/submission/api_get_submission_master.php', [
            'group_id' => $id,
        ]);
        // list group that belongs to this teacher
        $responseGroup = Http::get(config('base_tahfidz_url') . 'group/grouping_mentor_info.php', [
            'mentor_id' => $mentor_id,
        ]);

        $announcement = $modelGroup->announcement;

        // list group that belongs to this teacher
        $groupData = json_decode($responseGroup);
        // list of submission that belongs to student teached by this teacher
        $dayta = json_decode($response);

        if ($groupData->response_code != 1) {
            $groupData = array();
        } else {
            $groupData = $groupData->group;
        }


        if ($dayta->response_code != 1) {
            $dayta = array();
        } else {
            $dayta = $dayta->submission;
        }


        $isGroup = true;
        $group_id = $modelGroup->id;
        return view('mentor.tahfidz-task.manage')->with(
            compact(
                'groupData',
                'dayta',
                'groupName',
                'modelGroup',
                'announcement',
                'isGroup',
                'group_id'
            )
        );
    }

    /**
     * update data setoran
     *
     * @return void
     */
    public function updateTask(Request $request)
    {

        $submission_id=$request->submission_id;

        $tahfidzTask = TahfidzTask::findOrFail($request->submission_id);
        $sendNotifToStudent = false;
        $rules = [
            'score'     => 'required',
            'submission_id'     => 'required',
            'score_ahkam'     => 'required',
            'score_itqan'     => 'required',
            'score_makhroj'     => 'required',
            'status'     => 'required',
            'correction'   => 'required',
        ];
        $customMessages = [
            'required' => 'Mohon Isi :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);

        if (!$request->hasFile('correction_audio')) {
         
            $tahfidzTask->update([
                'score_ahkam'     => $request->score_ahkam,
                'score_itqan'     => $request->score_itqan,
                'score_makhroj'     => $request->score_makhroj,
                'score'     => $request->score,
                'status'     => $request->status,
                'correction'     => $request->correction,
            ]);
            if ($tahfidzTask) {
                $sendNotifToStudent = true;
                //redirect dengan pesan sukses
                return redirect("mentor/tahfidz/task/$request->submission_id")->with(['success' => 'Penilaian Berhasil Disimpan!']);
            } else {
                //redirect dengan pesan error
                return redirect("mentor/tahfidz/task/$request->submission_id")->with(['error' => 'Penilaian Gagal Disimpan!']);
            }
        } else if ($request->hasFile('correction_audio')) {
            $urlAPI = config('base_tahfidz_url') . "submission/upload_correction_audio.php";
            $extension = $request->file('correction_audio')->extension();
            $file_name = $request->submission_id.".".$extension;
            $response = Http::attach(
                'input_correction',
                file_get_contents($request->correction_audio),
                $file_name
            )->post($urlAPI, [
                "submission_id" => $request->submission_id
            ]);

            $dayta = json_decode($response);
            $status = false;
            if ($dayta->response_code != 1) {
                $dayta = array();
                $status = false;
            } else {
                $tahfidzTask = TahfidzTask::findOrFail($request->submission_id);
                $tahfidzTask->update([
                    'score_ahkam'     => $request->score_ahkam,
                    'score_itqan'     => $request->score_itqan,
                    'score_makhroj'     => $request->score_makhroj,
                    'score'     => $request->score,
                    'status'     => $request->status,
                    'correction'     => $request->correction,
                ]);
                $status = true;
            }
            

         
            if ($status && $tahfidzTask) {
                $sendNotifToStudent = true;
                return redirect("mentor/tahfidz/task/$request->submission_id")->with(['success' => 'Penilaian Berhasil Disimpan!']);
            } else {
                return redirect("mentor/tahfidz/task/$request->submission_id")->with(['error' => 'Penilaian Gagal Disimpan!']);
            }
        }

        if($sendNotifToStudent){
            $this->sendNotification("Test","Test2");
        }
    }


    /**
     * hapus setoran siswa
     *
     * @return void
     */
    public function delete($id)
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
            return redirect("mentor/tahfidz/task")->with(['success' => 'Setoran Berhasil Dihapus']);
        } else {
            return redirect("mentor/tahfidz/task")->with(['error' => 'Setoran Gagal Dihapus']);
        }
    }

    /**
     * hapus file audio
     *
     * @return void
     */
    public function deleteCorrectionAudio($id)
    {
        $urlAPI = config('base_tahfidz_url') . '/submission/delete_correction_audio.php';
        $response = Http::asForm()->post($urlAPI, [
            'submission_id' => $id,
        ]);
        $response=json_decode($response);
        if ($response->response_code !=1) {
            return redirect("mentor/tahfidz/task/$id")->with(['error' => "$response->info"]);
        }else{
            return redirect("mentor/tahfidz/task/$id")->with(['success' => "Koreksi Dengan Audio Berhasil Dihapus"]);
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
