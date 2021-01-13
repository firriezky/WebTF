<?php

namespace App\Http\Controllers;

use App\Models\TahfidzTask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;

class AdminTaskTahfidzController extends Controller
{
    public function allStudent()
    {
        $dayta = DB::table("mentor_submission")->simplePaginate(15);
        return view('admin.student.student')->with('dayta', $dayta);
    }

    public function createStudent()
    {
        $dayta = DB::select("select * from student");
        return view('admin.student.import')->with('dayta', $dayta);
    }


    

    public function manageTask()
    {
        $response = Http::post('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', []);
        $dayta = json_decode($response);
        $dayta = $dayta->submission;
        Paginator::useBootstrap();
        return view('admin.tahfidz-task.manage')->with('dayta', $dayta);
    }

    public function getTask()
    {
        $dayta = DB::table("student");
        return view('admin.tahfidz-task.manage')->with('dayta', $dayta);
    }
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $blog
     * @return void
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required',
            'title'     => 'required',
            'title'     => 'required',
            'title'     => 'required',
            'title'     => 'required',
            'content'   => 'required'
        ]);

        $lesson = TahfidzTask::findOrFail($request->id);

        if ($request->file('image') == "" && $request->file('video') == "") {
            $lesson->update([
                'course_title'     => $request->title,
                'course_description'   => $request->content,
                'course_category'     => $request->input('category')
            ]);

            $lesson->update([
                'course_title'     => $request->title,
                'course_trailer'     => $video->hashName(),
                'course_category'     => $request->input('category'),
                'course_description'   => $request->content
            ]);
        }
        if ($lesson) {
            //redirect dengan pesan sukses
            return redirect('lesson/manage')->with(['success' => 'Data Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect('lesson/manage')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }
}
