<?php

namespace App\Http\Controllers;

use App\Models\TbKepalaSekolah;
use App\Models\Pengguna;
use App\Models\TbPetuga;
use App\Models\TbSiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    // Menampilkan form login
    public function showLoginForm()
    {
        return view('login');
    }
    public function showRegisterForm()
    {
        return view('register');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $pengguna = Pengguna::where('email', $credentials['email'])
            ->orWhere('username', $credentials['email'])
            ->first();
        if ($pengguna && Hash::check($credentials['password'], $pengguna->PASSWORD)) {
            Auth::login($pengguna);
            return redirect()->intended('dashboard');
        }
        return redirect()->back()->with('error', 'Email atau Password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('login');
    }
}
