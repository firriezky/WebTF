<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Mentor;
use App\Models\Student;
use Illuminate\Http\Request;
use DB;
use Exception;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function allGroup(){
        $dayta = DB::select("select * from mentor_grouping");
        $mentor = DB::select("select * from mentor");
        return view('admin.group.manage')->with(compact('dayta','mentor'));
    }

    public function update($id){
        $group = Group::findOrFail($id);
        $mentor = DB::select("select * from mentor");
        $dayta = DB::select("select * from group_data_for_student where group_id=$id");
        return view('admin.group.see')->with(compact('dayta','group','mentor'));
    }

    public function create(){
        return view('admin.group.import');
    }

    public function simpan(Request $request)
    {
        try {
            //code causing exception to be thrown
            $rules = [
                'name'     => 'required',
                'mentor'     => 'required',
                'category'     => 'required',
            ];
            $customMessages = [
                'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
            ];
            $this->validate($request, $rules, $customMessages);

            $inputDeyta = Group::create([
                'name'     => $request->name,
                'id_mentor'     => $request->mentor,
                'category'     => $request->category,
                'announcement'     => "Belum Ada Pengumuman",
            ]);

            if ($inputDeyta) {
                //redirect dengan pesan sukses
                return redirect("admin/group/manage")->with(['success' => "Berhasil Membuat Kelompok $request->name"]);
            } else {
                //redirect dengan pesan error
                return redirect("admin/group/manage")->with(['error' => "Gagal Membuat Kelompok $request->name"]);
            }
        } catch (Exception $e) {
            return redirect("admin/group/manage")->with(['error' => "Error $e Akhi!"]);
        }
    }

    public function destroy($id)
    {
        $group = Group::findOrFail($id);

        $group->delete();

        if ($group) {
            //redirect dengan pesan sukses
            return redirect("admin/group/manage")->with(['success' => "Kelompok $group->name Berhasil Dihapus!"]);
        } else {
            //redirect dengan pesan error
            return redirect("admin/group/manage")->with(['error' => 'Kelompok Gagal Dihapus!']);
        }
    }


    public function insert_student(Request $request)
    {
        $rules = [
            'nisn'     => 'required',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);
        $group_id = $request->group_id;

        $student = Student::where('nisn', $request->nisn)->first();
        if ($student==null) {
            return redirect("/group/$group_id/edit")->with(['error' => "NISN Tidak Ditemukan"]);
        }
        $group = Group::findOrFail($request->group_id);
        

        $student->update([
            'id_kelompok'     => $group_id,
        ]);

        if ($student) {
            //redirect dengan pesan sukses
            return redirect("/group/$group_id/edit")->with(['success' => "$student->name Berhasil Ditambahkan Ke Kelompok"]);
        } else {
            //redirect dengan pesan error
            return redirect("/group/$group_id/edit")->with(['error' => "$student->name Gagal Ditambahkan Ke Kelompok!"]);
        }
    }

    public function change_mentor(Request $request)
    {
        $rules = [
            'mentor_id'     => 'required',
            'group_id'     => 'required',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);
        $group_id = $request->group_id;



        $mentor = Mentor::where('id', $request->mentor_id)->first();
        if ($mentor==null) {
            return redirect("/group/$group_id/edit")->with(['error' => "Pembimbing Tidak Ditemukan , Silakan Coba Lagi Nanti"]);
        }
        $group = Group::findOrFail($group_id);        

         $group->update([
            'id_mentor'     => $request->mentor_id,
        ]);

        if ($group) {
            //redirect dengan pesan sukses
            return redirect("/group/$group_id/edit")->with(['success' => "Berhasil Mengganti Mentor Kelompok"]);
        } else {
            //redirect dengan pesan error
            return redirect("/group/$group_id/edit")->with(['error' => "Gagal Mengganti Mentor Kelompok"]);
        }
    }

    public function remove_student(Request $request)
    {
        // dd($request->all());
        $student = Student::findOrFail($request->student_id);
        $group = Group::findOrFail($request->group_id);
        $group_id = $request->group_id;
        

        $student->update([
            'id_kelompok'     => NULL,
        ]);
        
        $delete = $student->delete();

        if ($delete) {
            //redirect dengan pesan sukses
            return redirect("/group/$group_id/edit")->with(['success' => "$student->name Berhasil Dihapus Dari Kelompok"]);
        } else {
            //redirect dengan pesan error
            return redirect("/group/$group_id/edit")->with(['error' => "$student->name Gagal Dihapus!"]);
        }
    }


    public function updateAnnouncement(Request $request)
    {
        $rules = [
            'announce'     => 'required',
        ];
        $customMessages = [
            'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
        ];
        $this->validate($request, $rules, $customMessages);
        $group_id = $request->group_id;
 
        $group = Group::findOrFail($request->group_id);
        

        $update = $group->update([
            'announcement'     => $request->announce,
        ]);

        if ($update) {
            //redirect dengan pesan sukses
            return redirect("mentor/tahfidz/task/group/17")->with(['success' => "Berhasil Mengupdate Pengumuman"]);
        } else {
            //redirect dengan pesan error
            return redirect("mentor/tahfidz/task/group/17")->with(['error' => "Gagal Mengupdate Pengumuman"]);
        }
    }


}
