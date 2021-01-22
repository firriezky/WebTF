<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Presensi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class AbsensiController extends Controller
{
        public function v_mentor(){
            $mentor_id = Auth::guard('mentor')->user()->id;

            $groupData = DB::table('kelompok')
            ->where('id_mentor', '=', $mentor_id)
            ->get();

            return view('mentor.presensi.init')->with(compact('groupData'));
        }

        public function vSeeReport(){
            $mentor_id = Auth::guard('mentor')->user()->id;

            $groupData = DB::table('kelompok')
            ->where('id_mentor', '=', $mentor_id)
            ->get();

            return view('mentor.presensi.init')->with(compact('groupData'));
        }

        


        public function mentorInputGroup($id){
            $mentor_id = Auth::guard('mentor')->user()->id;

            $groupData = Group::findOrFail($id);


            $students = DB::table('student')
            ->where('id_kelompok', '=', $id)
            ->get();

            $agendas = DB::table('agenda')
            ->orderBy('id','desc')
            ->get();
    
            return view('mentor.presensi.input')->with(compact('students','agendas','groupData'));
        }

        public function store(Request $request){
            $mentor_id = Auth::guard('mentor')->user()->id;
            $status = $request->status;
            foreach ($request->student as $key => $value) {
                $status = true;
                $inputDeyta = Presensi::create([
                    'student_id' => $value,
                    'agenda_id' => $request->id_agenda,
                    'mentor_id' => $mentor_id,
                    'status' => $request->status[$key],
                ]);
    
                if ($inputDeyta) {
                    $status=true;
                } else {
                    $status=false;
                }
            }
            if($status){
            return redirect('tahfidz/presensi/report')->with(['success' => 'Absensi Berhasil Disimpan']);
            }else{
            return redirect('tahfidz/presensi/report')->with(['success' => 'Absensi Gagal Disimpan']);
            }


          

        //    $inputstring="hello,test";
        //     $str_explode=explode(",",$inputstring);
        //     $string1 = $str_explode[0]; // hello
        //     $string2 = $str_explode[1]; // test
    
        //     return view('mentor.presensi.input')->with(compact('students','agendas','groupData'));
        }


}
