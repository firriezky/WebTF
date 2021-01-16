<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\TahfidzTask;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

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
                'mentor_id' => Auth::guard('mentor')->user()->id,
            ]);

        $responseGroup =
            Http::get(config('base_tahfidz_url') . '/group/grouping_mentor_info.php', [
                'mentor_id' => Auth::guard('mentor')->user()->id,
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
        $rules = [
            'score'     => 'required',
            'submission_id'     => 'required',
            'score_ahkam'     => 'required',
            'score_itqan'     => 'required',
            'score_makhroj'     => 'required',
            'status'     => 'required',
            'correction'   => 'required'
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);

        $task_id = $request->submission_id;

        $tahfidzTask = TahfidzTask::findOrFail($request->submission_id);

        $tahfidzTask->update([
            'score-ahkam'     => $request->score_ahkam,
            'score-itqan'     => $request->score_itqan,
            'score-makhroj'     => $request->score_makhroj,
            'score'     => $request->score,
            'status'     => $request->status,
            'correction'     => $request->correction,
        ]);

        if ($tahfidzTask) {
            //redirect dengan pesan sukses
            return redirect("mentor/tahfidz/task/$request->submission_id")->with(['success' => 'Penilaian Berhasil Disimpan!']);
        } else {
            //redirect dengan pesan error
            return redirect("mentor/tahfidz/task/$request->submission_id")->with(['error' => 'Penilaian Gagal Disimpan!']);
        }
    }


    /**
     * update data setoran
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
        dd($dayta);
        $status = false;
        if ($dayta->response_code != 1) {
            $dayta = array();
        } else {
            $dayta = $dayta->submission;
        }
        return redirect("mentor/tahfidz/task")->with(compact('dayta'));
    }
}
