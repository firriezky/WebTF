<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MentorController extends Controller
{

    /**
     * update mentor profile
     *
     * @param  mixed $request
     * @return void
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'photo'     => 'image|mimes:png,jpg,jpeg',
            'name'     => 'required',
            'contact'     => 'required',
        ]);

        $user = Mentor::findOrFail(Auth::guard('mentor')->user()->id);
        $stat = false;
        //if user not updating image
        if ($request->file('photo') == "") {
            $user->update([
                'name' => $request->name,
                'contact' => $request->contact,
            ]);
            if ($user) {
                $stat=true;
            }

            //if user is updating image
        } else if ($request->file('photo') != "") {
            $urlAPI = config('base_tahfidz_url') . "mentor/update_img.php";
            $extension = $request->file('photo')->extension();

            $response = Http::attach(
                'uploaded_files',
                file_get_contents($request->photo),
                $user->contact . $extension
            )->post($urlAPI, [
                "mentor_id" => $user->id
            ]);

            $response = json_decode($response);
         
            if ($response->response_code == 1) {
                //Profile Is Updated via API , we dont change name here - Henry
                $user->update([
                    'name' => $request->name,
                    'contact' => $request->contact,
                ]);
                if ($user) {
                    $stat = true;
                }else{
                    $stat = false;
                }
            }else{
                $stat = false;
            }
        }
        if ($stat) {
            //redirect dengan pesan sukses
            return redirect('mentor/profile')->with(['success' => 'Data Berhasil Diupdate!']);

        } else {
            //redirect dengan pesan error
            return redirect('mentor/profile')->with(['error' => 'Data Gagal Diupdate!']);
        }
    }

    /**
     * update password mentor
     *
     * @param  mixed $request
     * @return void
     */
    public function updatePassword(Request $req){
        $urlAPI = config('base_tahfidz_url') . "mentor/update_pass_user.php";
        $userID = Auth::guard('mentor')->user()->id;
        $this->validate($req, [
            'old_pass'     => 'required|min:6',
            'new_pass'     => 'required|min:6|confirmed',
            'new_pass_confirmation'     => 'required',
        ]);

        $response = Http::asForm()->post($urlAPI, [
            'mentor_id' => $userID,
            'old_password' => $req->old_pass,
            'new_password' => $req->new_pass,
        ]);

        $response=json_decode($response);

        if ($response->response_code==3) {
            return redirect('mentor/profile')->with(['error' => 'Password Lama Tidak Sesuai']);
        }
        if ($response->response_code==1) {
            return redirect('mentor/profile')->with(['success' => 'Password Berhasil Diupdate']);
        }
        if ($response->response_code==0) {
            return redirect('mentor/profile')->with(['error' => 'Password Gagal Diupdate']);
        }
    }
}
