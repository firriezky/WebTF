<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeStudentController extends Controller
{
    public function view_task(){
        // $group = Group::findOrFail($id);
        // $mentor = DB::select("select * from mentor");
        // $dayta = DB::select("select * from group_data_for_student where group_id=$id");
        return view('student.manage_task');
    }

    public function view_group(){
        $group = Group::find(Auth::guard('student')->user()->id_kelompok);
 
        $mentor = null;
        $groupMember=null;
 
        if ($group!=null) {
            $mentor = Mentor::find($group->id_mentor);
            $groupMember = DB::select("select * from group_data_for_student where group_id='$group->id'");
        }
        
        else{ $groupMember==null;}
        return view('student.group')->with(compact('group','groupMember','mentor'));
    }
    
}
