<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class MentorTaskController extends Controller
{
    public function manage()
    {
        $groupName = "Daftar Semua Siswa";
        $mentor_id =  Auth::guard('mentor')->user()->id;
        $group = null;

        $response =
            Http::get('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', [
                'mentor_id' => Auth::guard('mentor')->user()->id,
            ]);

        $responseGroup =
            Http::get('http://tahfidz.sditwahdahbtg.com/group/grouping_mentor_info.php', [
                'mentor_id' => Auth::guard('mentor')->user()->id,
            ]);


        $groupData = json_decode($responseGroup);
        if ($groupData->response_code != 1) {
            $groupData = [];
        } else {
            $groupData = $groupData->group;
        }

        $dayta = json_decode($response);
        if ($dayta->response_code != 1) {
            $dayta = [];
        } else {
            $dayta = $dayta->submission;
        }

        return view('mentor.tahfidz-task.manage')->with(compact('groupData', 'dayta','groupName'));
    }

    public function taskByGroup($id)
    {
        $modelGroup = Group::findOrFail($id);
        $groupName = $modelGroup->name;
        $mentor_id =  Auth::guard('mentor')->user()->id;
        $group = null;
        $className = null;

        // list of submission that belongs to student teached by this teacher
        $response = Http::get('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', [
            'group_id' => $id,
        ]);
        // list group that belongs to this teacher
        $responseGroup = Http::get('http://tahfidz.sditwahdahbtg.com/group/grouping_mentor_info.php', [
            'mentor_id' => $mentor_id,
        ]);


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
        return view('mentor.tahfidz-task.manage')->with(compact('groupData', 'dayta','groupName'));
    }


    public function edit($id)
    {
        $data = Http::get('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', [
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
}
