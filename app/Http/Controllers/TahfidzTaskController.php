<?php

namespace App\Http\Controllers;


use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;


class TahfidzTaskController extends Controller
{
    public function manageTask(){
        $response = Http::post('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', [
        ]);

        $dayta = json_decode($response);
        $dayta = $dayta->submission;
        // dd($dayta);
        return view('mentor.tahfidz-task.manage')->with('dayta', $dayta);
    }

    public function viewStudent(){
        $id =  Auth::guard('student')->user()->id;
        $response = Http::get('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', [
        "student_id" => Auth::guard('student')->user()->id,
            ]);

        $dayta = json_decode($response);
        $dayta = $dayta->submission;
        return view('student.manage_task')->with('dayta', $dayta);
    }

    public function viewCreate(){
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
            $this->validate($request, $rules, $customMessages);   
                 
            return redirect("student/task/create")->with(['error' => "Error Testing"]);
        }
}
