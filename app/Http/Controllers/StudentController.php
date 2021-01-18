<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class StudentController extends Controller
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

        // $response_compact =
        //     compact(
        //         'allTahfidzTask',
        //         'tahfidzTask0',
        //         'tahfidzTask1',
        //         'tahfidzTask3',
        //         'myGroupCount',
        //         'groupInfo',
        //         'recent',
        //         'group',
        //         'user'
        //     );
        // return $response_compact;
    }


    public function retrieveAll()
    {
        $dayta = DB::select("select * from student");
        return view('student.data')->with('dayta', $dayta);
    }

    public function destroy($id)
    {
        $student = Student::findOrFail($id);

        $student->delete();

        if ($student) {
            //redirect dengan pesan sukses
            return redirect("admin/student/manage")->with(['success' => 'Siswa Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect("admin/student/manage")->with(['error' => 'Siswa Gagal Dihapus!']);
        }
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function simpan(Request $request)
    {
        try {
            //code causing exception to be thrown
            $rules = [
                'name'     => 'required',
                'kelas'     => 'required',
                'nisn'     => 'required|numeric',
                'contact'     => 'required|numeric',
            ];
            $customMessages = [
                'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
            ];
            $this->validate($request, $rules, $customMessages);

            $inputDeyta = Student::create([
                'name'     => $request->name,
                'nisn'     => $request->nisn,
                'contact'     => $request->contact,
                'email'     => $request->email,
                'id_kelompok'     => NULL,
                'url_profile'     => "",
                'gender'     => $request->gender,
                'kelas'     => $request->kelas,
                'password' => Hash::make('bismillah')
            ]);

            if ($inputDeyta) {
                //redirect dengan pesan sukses
                return redirect("admin/student/manage")->with(['success' => "Siswa Atas Nama $request->name Berhasil Disimpan!"]);
            } else {
                //redirect dengan pesan error
                return redirect("admin/student/manage")->with(['error' => 'Siswa Gagal Disimpan!']);
            }
        } catch (Exception $e) {
            abort(401, $e);
            return redirect("admin/student/manage")->with(['error' => "Error $e Akhi!"]);
        }
    }

    /**
     * edit
     *
     * @return void
     */
    public function edit(Request $request)
    {

        $student = Student::findOrFail($request->id);

        $student->update([
            'name'     => $request->name,
            'nisn'     => $request->nisn,
            'contact'     => $request->contact,
            'email'     => $request->email,
            'gender'     => $request->gender,
            'kelas'     => $request->kelas,
        ]);

        if ($student) {
            //redirect dengan pesan sukses
            return redirect("admin/student/manage")->with(['success' => 'Data Siswa Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect("admin/student/manage")->with(['error' => 'Data Siswa Gagal Diupdate!']);
        }
    }

    /**
     * edit
     *
     * @return void
     */
    public function resetPassword(Request $request)
    {

        $student = Student::findOrFail($request->id);

        $student->update([
            'password' => Hash::make($request->password)
        ]);

        if ($student) {
            //redirect dengan pesan sukses
            return redirect("admin/student/manage")->with(['success' => 'Password Siswa Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect("admin/student/manage")->with(['error' => 'Password Siswa Gagal Diupdate!']);
        }
    }


        /**
     * update password student
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $req)
    {
        $urlAPI = config('base_tahfidz_url') . "mentor/update_pass_user.php";
        $userID = Auth::guard('student')->user()->id;
        $this->validate($req, [
            'old_pass'     => 'required|min:6',
            'new_pass'     => 'required|min:6|confirmed',
            'new_pass_confirmation'     => 'required',
        ]);

        $response = Http::asForm()->post($urlAPI, [
            '_id' => $userID,
            'old_password' => $req->old_pass,
            'new_password' => $req->new_pass,
        ]);

        $response = json_decode($response);

        if ($response->response_code == 3) {
            return redirect('mentor/profile')->with(['error' => 'Password Lama Tidak Sesuai']);
        }
        if ($response->response_code == 1) {
            return redirect('mentor/profile')->with(['success' => 'Password Berhasil Diupdate']);
        }
        if ($response->response_code == 0) {
            return redirect('mentor/profile')->with(['error' => 'Password Gagal Diupdate']);
        }
    }
}
