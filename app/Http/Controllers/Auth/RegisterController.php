<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mentor;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
        //raz-comment : additional guard for additional users
        $this->middleware('guest:mentor');
        $this->middleware('guest:student');
    }

    public function showStudentRegisterForm()
    {
        return view('auth.student.register', ['url' => 'admin']);
    }

    public function showMentorRegisterForm()
    {
        return view('auth.mentor.register', ['url' => 'writer']);
    }

    protected function createMentor(Request $request)
    {
        $this->validate($request, [
            'contact' => 'required|min:9|unique:mentor|numeric',
            'name' => 'required|min:5|string',
            'gender' => 'required',
            'password' => 'min:6|required_with:password_confirmation|same:password_confirmation',
            'password_confirmation' => 'min:6'
        ]);


        $mentor = Mentor::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'contact' => $request['contact'],
            'gender' => $request['gender'],
            'url_profile' => "",
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/mentor');
    }

    protected function createStudent(Request $request)
    {
        $this->validator($request->all())->validate();
        $mentor = Mentor::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
        ]);
        return redirect()->intended('login/student');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }



    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            // 'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'contact' => ['required', 'string', 'min:8'],
        ]);
    }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return \App\Models\User
    //  */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'name' => $data['name'],
    //         'email' => $data['email'],
    //         'contact' => $data['contact'],
    //         'password' => Hash::make($data['password']),
    //     ]);
    // }
}
