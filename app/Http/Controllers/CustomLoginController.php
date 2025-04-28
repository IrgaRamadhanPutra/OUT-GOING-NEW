<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Session;

class CustomLoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        // dd($request);

        $user = $request->input('user');
        $password = md5($request->input('password')); // Mengenkripsi kata sandi dengan MD5

        // $credentials = [
        //     'user' => $user,
        //     'password' => $password,
        // ];
        $check = User::where('user', $user)
            ->where('pass', $password)
            ->first();
        // dd($check);
        if ($check) {

            Auth::login($check);
            return redirect('/index_out_going');
        } else {
            //jika tidak di kembalikan ke auth
            // Session::flash('message', 'My message');
            Session::flash('message', 'User atau Password salah');
            Session::flash('error', 'Silahkan login kembali ');
            return redirect('/login');
        }
        // if (Auth::attempt($credentials)) {
        //     // Jika berhasil login, arahkan ke halaman yang sesuai
        //     return redirect('/');
        // }

        // Jika gagal login, arahkan kembali ke halaman login
        return redirect()->route('login')->with('error', 'Login failed.');
    }

    // Logout user
    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
