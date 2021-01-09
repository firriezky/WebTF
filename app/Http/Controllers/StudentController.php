<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{


    public function retrieveAll(){
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
}
