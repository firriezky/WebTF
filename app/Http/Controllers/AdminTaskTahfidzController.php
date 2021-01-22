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

}
