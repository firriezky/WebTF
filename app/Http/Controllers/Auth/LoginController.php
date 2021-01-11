<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:mentor')->except('logout');
        $this->middleware('guest:student')->except('logout');
    }


    //raz-comment : 
    // Login for Mentor/Teacher/Muhaffidz
    public function showMentorLoginForm()
    {
        return view('auth.mentor.login');
    }

    public function mentorLogin(Request $request)
    {
        $this->validate($request, [
            'contact'   => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('mentor')->attempt(
            [
                'contact' => $request->contact,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {

            return redirect()->intended('/mentor');
        } else {
            return redirect('login/mentor')->withErrors([
                'failed' => 'Username Atau Password Salah'
            ]);
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    //raz-comment : Student Login Form

    public function showStudentLoginForm()
    {
        return view('auth.student.login', ['url' => 'writer']);
    }

    public function studentLogin(Request $request)
    {
        $this->validate($request, [
            'nisn'   => 'required|numeric',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('student')->attempt(
            [
                'nisn' => $request->nisn,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->intended('/student');
        } else {
            return redirect('login/student')->withErrors([
                'failed' => 'Username Atau Password Salah'
            ]);
        }
        return back()->withInput($request->only('nisn', 'remember'));
    }

    public function username()
    {
        return 'email';
    }


    public function logoutStudent(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }

    public function logoutMentor(Request $request)
    {
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->flush();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
    }
}
