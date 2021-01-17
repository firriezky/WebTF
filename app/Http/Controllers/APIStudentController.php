<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class APIStudentController extends Controller
{
    public function home()
    {
        $student_id =  Auth::guard('student')->user()->id;
        $group_id = Auth::guard('student')->user()->id_kelompok;
        $allTahfidzTask =
            DB::table('admin_submission')
            ->where('student_id', '=', $student_id)
            ->count();

        $tahfidzTask0 =
            DB::table('admin_submission')
            ->where('student_id', '=', $student_id)
            ->where('status', '=', 0)
            ->count();

        $tahfidzTask1 =
            DB::table('admin_submission')
            ->where('student_id', '=', $student_id)
            ->where('status', '=', 1)
            ->count();


        $tahfidzTask3 =
            DB::table('admin_submission')
            ->where('student_id', '=', $student_id)
            ->where('correction', '=', '')
            ->count();

        $myGroupCount =
            DB::table('group_data_for_student')
            ->where('group_id', '=', $group_id)
            ->count();

        $group =
            DB::table('group_data_for_student')
            ->where('group_id', '=', $group_id)
            ->get();
        $groupInfo = array();
        if (empty($group)) {
            $group = array();
        } else {
            $groupInfo = $group[0];
        }
        
        $user=Student::findOrFail($student_id);



        $recent = Http::get(config('base_tahfidz_url') . '/submission/api_get_submission_master.php', [
            'group_id' => $group_id,
        ]);


        $recent = json_decode($recent);
        //check API response
        if ($recent->response_code == 1) {
            $recent = $recent->submission;
            $recent = array_slice($recent, 0, 20);
        } else {
            $recent = array();
        }
        return view('student.home')->with(compact(
            'allTahfidzTask',
            'tahfidzTask0',
            'tahfidzTask1',
            'tahfidzTask3',
            'group',
            'groupInfo',
            'myGroupCount',
            'recent'
        ));  
    }
}
