<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class AdminStudentController extends Controller
{
    public function allStudent(){
        $dayta = DB::select("select * from student");
        return view('admin.student.student')->with('dayta', $dayta);
    }

    public function createStudent(){
        $dayta = DB::select("select * from student");
        return view('admin.student.import')->with('dayta', $dayta);
    }

    public function manageStudent(){
        $dayta = DB::select("select * from student");
        return view('admin.student.manage')->with('dayta', $dayta);
    }


}
