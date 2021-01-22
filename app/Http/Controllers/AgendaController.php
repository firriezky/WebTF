<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    public function adminSee()
    {
        $dayta = DB::table("agenda")->get();
        return view('admin.agenda.manage')->with('dayta', $dayta);
    }

    public function vAdminCreate()
    {
        $dayta = DB::table("mentor_submission");
        return view('admin.agenda.create');
    }


        /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function simpanByAdmin(Request $request)
    {
            //code causing exception to be thrown
            $rules = [
                'title'     => 'required',
                'start'     => 'required|date',
                'end'     => 'required|date|after_or_equal:start',
                'type'     => 'required',
            ];
            $customMessages = [
                'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
            ];            
            $this->validate($request, $rules, $customMessages);

            $description = "";
            if($request->description !="" || $request->description !=null){
                $description= $request->description;
            }

            $inputDeyta = Agenda::create([
                'title'     => $request->title,
                'start'     => $request->start,
                'end'     => $request->end,
                'type'     => $request->type,
                'description'     => $description,
            ]);

            if ($inputDeyta) {
                //redirect dengan pesan sukses
                return redirect("admin/agenda/manage")->with(['success' => "Agenda Berhasil Dibuat"]);
            } else {
                //redirect dengan pesan error
                return redirect("admin/agenda/create")->with(['error' => 'Agenda Gagal Disimpan']);
            }
       
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function editByAdmin(Request $request)
    {
            //code causing exception to be thrown
            $rules = [
                'u_title'     => 'required',
                'u_start'     => 'required|date',
                'u_end'     => 'required|date|after_or_equal:start',
                'u_type'     => 'required',
            ];
            $customMessages = [
                'required' => 'Mohon Isi Kolom :attribute terlebih dahulu'
            ];            
            $this->validate($request, $rules, $customMessages);

            $description = "";
            if($request->u_description !="" || $request->u_description !=null){
                $description= $request->u_description;
            }

            $agenda = Agenda::findOrFail($request->id);
            $agenda->update([
                'title'     => $request->u_title,
                'start'     => $request->u_start,
                'end'     => $request->u_end,
                'type'     => $request->u_type,
                'description'     => $description,
            ]);

            if ($agenda) {
                //redirect dengan pesan sukses
                return redirect("admin/agenda/manage")->with(['success' => "Agenda Berhasil Diupdate"]);
            } else {
                //redirect dengan pesan error
                return redirect("admin/agenda/create")->with(['error' => 'Agenda Gagal Diupdate']);
            }
       
    }


    public function deleteByAdmin(Request $request){
        $agenda = Agenda::findOrFail($request->id);
        $agenda->delete();
        if ($agenda) {
            //redirect dengan pesan sukses
            return redirect("admin/agenda/manage")->with(['success' => "Agenda Berhasil Dihapus"]);
        } else {
            //redirect dengan pesan error
            return redirect("admin/agenda/manage")->with(['error' => 'Agenda Gagal Dihapus']);
        }
    }

}
