<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
    }

    // Di LoginController
    public function login(Request $request)
    {
        // Deteksi asal login (dari siswa/guru)
        $routeName = $request->route()->getName();

        if ($routeName == 'login.siswa' || $request->input('role') == 'siswa') {
            // ===== LOGIN SISWA TANPA PASSWORD =====
            $request->validate([
                'identity' => 'required|string',
            ]);

            $user = User::where('nisn', $request->identity)->first();

            if (!$user) {
                return back()->withErrors(['identity' => 'NISN tidak ditemukan']);
            }
            // Pastikan user role-nya siswa
            if (!$user->hasRole('Siswa')) {
                return back()->withErrors(['identity' => 'Akun ini bukan akun siswa']);
            }

            Auth::login($user);
            return redirect('/admin'); // atau dashboard siswa
        } else {
            // ===== LOGIN GURU/ADMIN DENGAN PASSWORD =====
            $request->validate([
                'identity' => 'required|string',
                'password' => 'required|string',
            ]);

            $user = User::where('nip', $request->identity)->first();

            if (!$user) {
                return back()->withErrors(['identity' => 'NIP tidak ditemukan']);
            }

            if (!\Hash::check($request->password, $user->password)) {
                return back()->withErrors(['password' => 'Password salah']);
            }

            if (!$user->hasRole('Admin')) {
                return back()->withErrors(['identity' => 'Akun ini bukan akun guru']);
            }

            Auth::login($user);
            return redirect('/admin'); // dashboard guru
        }
    }
    
    public function showGuruLoginForm()
    {
        // Kirim param jenis login (opsional) ke view, supaya form tahu labelnya
        return view('auth.loginGuru', ['role' => 'admin']);
    }

    public function showSiswaLoginForm()
    {
        return view('auth.loginSiswa', ['role' => 'siswa']);
    }

}
