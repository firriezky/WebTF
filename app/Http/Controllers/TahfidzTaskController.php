<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TahfidzTaskController extends Controller
{
    public function manageTask(){
        $response = Http::post('http://tahfidz.sditwahdahbtg.com/submission/api_get_submission_master.php', [
        ]);

        // $dayta = DB::table("admin_submission")->get();
        $dayta = json_decode($response);
        $dayta = $dayta->submission;
        // dd($dayta);
        return view('mentor.tahfidz-task.manage')->with('dayta', $dayta);
    }
}
