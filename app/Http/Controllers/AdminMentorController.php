<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminMentorController extends Controller
{
    public function create()
    {
        return view('admin.mentor.import');
    }

    public function manage()
    {
        $dayta = DB::select("select * from mentor");
        return view('admin.mentor.manage')->with('dayta', $dayta);
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
                'email'     => 'required',
                'contact'     => 'required|numeric',
            ];
            $customMessages = [
                'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
            ];
            $this->validate($request, $rules, $customMessages);

            $inputDeyta = Mentor::create([
                'name'     => $request->name,
                'contact'     => $request->contact,
                'email'     => $request->email,
                'url_profile'     => "",
                'gender'     => $request->gender,
                'kelas'     => $request->kelas,
                'password' => Hash::make('Wahdah Islamiyah')
            ]);

            if ($inputDeyta) {
                //redirect dengan pesan sukses
                return redirect("admin/mentor/manage")->with(['success' => "Guru Atas Nama $request->name Berhasil Disimpan!"]);
            } else {
                //redirect dengan pesan error
                return redirect("admin/mentor/manage")->with(['error' => 'Guru Gagal Disimpan!']);
            }
        } catch (Exception $e) {
            return redirect("admin/mentor/manage")->with(['error' => "Error $e Akhi!"]);
        }
    }



    /**
     * edit
     *
     * @return void
     */
    public function edit(Request $request)
    {

        $mentor = Mentor::findOrFail($request->id);

        $mentor->update([
            'name'     => $request->name,
            'contact'     => $request->contact,
            'email'     => $request->email,
            'gender'     => $request->gender,
        ]);

        if ($mentor) {
            //redirect dengan pesan sukses
            return redirect("admin/mentor/manage")->with(['success' => 'Data Guru Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect("admin/mentor/manage")->with(['error' => 'Data Guru Gagal Diupdate!']);
        }
    }

    /**
     * edit
     *
     * @return void
     */
    public function resetPassword(Request $request)
    {

        $mentor = Mentor::findOrFail($request->id);

        $mentor->update([
            'password' => Hash::make($request->password)
        ]);

        if ($mentor) {
            //redirect dengan pesan sukses
            return redirect("admin/mentor/manage")->with(['success' => 'Password Guru Berhasil Diupdate!']);
        } else {
            //redirect dengan pesan error
            return redirect("admin/mentor/manage")->with(['error' => 'Password Guru Gagal Diupdate!']);
        }
    }

    public function destroy($id)
    {
        $mentor = Mentor::findOrFail($id);

        $mentor->delete();

        if ($mentor) {
            //redirect dengan pesan sukses
            return redirect("admin/mentor/manage")->with(['success' => 'Data Guru Berhasil Dihapus!']);
        } else {
            //redirect dengan pesan error
            return redirect("admin/mentor/manage")->with(['error' => 'Data Guru Dihapus!']);
        }
    }
}
