<?php

namespace App\Http\Controllers;

use App\Models\TahfidzQuiz;
use App\Models\TahfidzTask;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class TahfidzQuizController extends Controller
{
    /**
     * manage all quiz
     *
     * @return void
     */
    public function manage()
    {
        $groupName = "Daftar Semua Kuis";
        $mentor_id =  Auth::guard('mentor')->user()->id;
        $group = null;


        $responseGroup =
            Http::get('http://tahfidz.sditwahdahbtg.com/group/grouping_mentor_info.php', [
                'mentor_id' => Auth::guard('mentor')->user()->id,
            ]);

        $groupData = json_decode($responseGroup);
        if ($groupData->response_code != 1) {
            $groupData = array();
        } else {
            $groupData = $groupData->group;
        }

        $quizData = DB::table("mentor_tahfidz_quiz")
            ->where('mentor_id', $mentor_id)->get();

        return view('mentor.tahfidz-task.quiz')->with(compact('groupData', 'quizData'));
    }


    public function save(Request $request)
    {
        try {
            $rules = [
                'title'     => 'required',
                'description'     => 'required',
                'link'     => 'required',
                'group_id'     => 'required',
            ];
            $customMessages = [
                'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
            ];
            $this->validate($request, $rules, $customMessages);

            $inputDeyta = TahfidzQuiz::create([
                'group_id'     => $request->group_id,
                'title'     => $request->title,
                'description'     => $request->description,
                'gform_link'     => $request->link,
            ]);

            if ($inputDeyta) {
                //redirect dengan pesan sukses
                return redirect("mentor/tahfidz/quiz")->with(['success' => "Berhasil Membuat Quiz"]);
            } else {
                //redirect dengan pesan error
                return redirect("mentor/tahfidz/quiz")->with(['error' => "Gagal Membuat Quiz"]);
            }
        } catch (Exception $e) {
            return redirect("mentor/tahfidz/quiz")->with(['error' => "Error $e Akhi!"]);
        }
    }

    public function delete(Request $request)
    {
        $quiz = TahfidzQuiz::findOrFail($request->id);
        $delete = $quiz->delete();
        if ($delete) {
            return redirect("mentor/tahfidz/quiz")->with(['success' => "Berhasil Menghapus Quiz"]);
        } else {
            return redirect("mentor/tahfidz/quiz")->with(['success' => "Gagal Menghapus Quiz"]);
        }
    }


    public function update(Request $request)
    {
        $rules = [
            'u_id'     => 'required',
            'u_title'     => 'required',
            'u_description' => 'required',
            'u_link'     => 'required',
            'u_group_id' => 'required',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);

        $quiz = TahfidzQuiz::findOrFail($request->u_id);

        $quiz->update([
            'group_id'     => $request->u_group_id,
            'title'     => $request->u_title,
            'description'     => $request->u_description,
            'gform_link'     => $request->u_link,
        ]);


        if ($quiz) {
            //redirect dengan pesan sukses
            return redirect("mentor/tahfidz/quiz")->with(['success' => "Berhasil Mengupdate Quiz"]);
        } else {
            //redirect dengan pesan error
            return redirect("mentor/tahfidz/quiz")->with(['error' => "Gagal Mengupdate Quiz"]);
        }
    }
}
