<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\Username;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    use Authenticatable;

    protected $redirectTo = '/home';

    protected $username;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');

        $this->username = $this->findUsername();
    }

    public function findUsername()
    {
        $login = request()->input('login');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }

    public function username()
    {
        return $this->username;
    }

    public function index()
    {
        // $dataUserSiswa = User::where('role', 'siswa')->get('id')->toArray();
        // $dataUserSiswa = User::where('role', 'siswa')->pluck('id')->toArray();
        // var_dump($dataUserSiswa);
        // $myString = implode(',', array_column($dataUserSiswa, 'id'));
        // dd(array_rand($dataUserSiswa));
        // dd($dataUserSiswa);
        // $dataUserSiswa->implode('id', ', ');



        return view('login', [
            'title' => config('app.name')
        ]);
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'login'    => 'required',
            'password' => 'required',
        ]);

        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL)
            ? 'email'
            : 'username';

        $request->merge([
            $login_type => $request->input('login')
        ]);

        if (Auth::attempt($request->only($login_type, 'password'))) {
            $request->session()->regenerate();
            Auth::user()->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);

            return redirect()->intended('/dashboard')->with('status', 'Login successfully!');
        }

        return back()->with(
            'fails',
            'These credentials do not match our records.',
        )->withInput();
    }


    public function authenticateOld(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', new Username],
            'password' => 'required',
            'email' => 'email'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            Auth::user()->update([
                'last_login_at' => Carbon::now()->toDateTimeString(),
                'last_login_ip' => $request->getClientIp()
            ]);

            return redirect()->intended('/dashboard')->with('status', 'Login successfully!');
        }

        return back()->with(
            'fails',
            'Sorry wrong credentials!',
        );
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('status', 'Logout successfully!');
    }
}
