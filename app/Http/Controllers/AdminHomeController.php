<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AdminHomeController extends Controller
{
    public function home()
    {
        $allTahfidzTask =
            DB::table('admin_submission')
            ->count();

        $mentorCount =
            DB::table('mentor')
            ->count();


        $tahfidzTask0 =
            DB::table('admin_submission')
            ->where('status', '=', 0)
            ->count();

        $tahfidzTask1 =
            DB::table('admin_submission')
            ->where('status', '=', 1)
            ->count();


        $tahfidzTask3 =
            DB::table('admin_submission')
            ->where('correction', '=', '')
            ->count();


        $myGroup =
            DB::table('kelompok')
            ->count();

        $myStudent =
            DB::table('group_data_for_student')
            ->count();

        $recent = Http::get(config('base_tahfidz_url') . '/submission/api_get_submission_master.php', []);
        $recent = json_decode($recent);
        //check API response
        if ($recent->response_code == 1) {
            $recent = $recent->submission;
            $recent = array_slice($recent, 0, 50);
        } else {
            $recent = array();
        }
        $compact = compact(
            'mentorCount',
            'allTahfidzTask',
            'tahfidzTask0',
            'tahfidzTask1',
            'tahfidzTask3',
            'myStudent',
            'myGroup',
            'recent'
        );
        return view('admin/home')->with($compact);
    }
}
