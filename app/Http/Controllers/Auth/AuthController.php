<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\{Dosen, Mahasiswa, User};

class AuthController extends Controller
{
    protected $maxAttempts = 5;
    protected $decayMinutes = 2;

    // protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest')->except('postLogout');
    }

    public function viewLogin()
    {
        return view('z_auth.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|min:3',
            'password' => 'required|min:2',
            'cf-turnstile-response' => 'required',
        ]);

        $token = $request->input('cf-turnstile-response');
        $secret = config('services.turnstile.secret_key');

        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://challenges.cloudflare.com/turnstile/v0/siteverify', [
            'secret' => $secret,
            'response' => $token,
            'remoteip' => $request->ip(),
        ]);

        if (!$response->json('success')) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorLogin' => 'Verifikasi Keamanan (Turnstile) gagal. Silakan coba lagi.']);
        }

        try {
            $cekMhs = Mahasiswa::where('mhs_nim', $request->username)->first();
            if ($cekMhs) {
                if ($this->_authMahasiswa($request)) {
                    $request->session()->regenerate();
                    session()->put('menu', 'menu_mhs');
                    session()->put('nama', $cekMhs->mhs_nama);
                    return redirect()->intended('/student');
                }
            } else {
                $cekDosen = Dosen::where('ds_nip', $request->username)->first();
                if ($cekDosen) {
                    if ($this->_authDosen($request)) {
                        $request->session()->regenerate();
                        session()->put('menu', 'menu_dosen');
                        session()->put('nama', $cekDosen->ds_nama);
                        session()->put('jur_id', $cekDosen->ds_jur_id);
                        return redirect()->intended('/lecturer');
                    }
                } else {
                    $cekAdmin = User::where('user_username', $request->username)->first();
                    if ($cekAdmin) {
                        if ($this->_authAdmin($request)) {
                            $request->session()->regenerate();
                            session()->put('menu', 'menu_admin');
                            session()->put('nama', $cekAdmin->user_nama);
                            return redirect()->intended('/admin');
                        }
                    } else {
                        return redirect()
                            ->back()
                            ->withInput()
                            ->withErrors(['errorLogin' => 'Login Gagal. ID tidak ditemukan!']);
                    }
                }
            }
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorLogin' => 'Terjadi kesalahan koneksi ke database. Pastikan server database (MySQL) sudah aktif.']);
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors(['errorLogin' => 'Terjadi kesalahan sistem. Silahkan coba beberapa saat lagi.']);
        }

        return redirect()
            ->back()
            ->withInput()
            ->withErrors(['errorLogin' => 'Login Gagal!']);
    }

    public function _authMahasiswa($request) : bool
    {
        if (Auth::guard('student')->attempt(['mhs_nim' => $request->username, 'password' => $request->password])) {
            return true;
        }
        return false;
    }

    public function _authDosen($request) : bool
    {
        if (Auth::guard('lecturer')->attempt(['ds_nip' => $request->username, 'password' => $request->password])) {
            return true;
        }
        return false;
    }

    public function _authAdmin($request) : bool
    {
        if (Auth::guard('admin')->attempt(['user_username' => $request->username, 'password' => $request->password])) {
            return true;
        }
        return false;
    }

    public function postLogout()
    {
        Auth::logout();
        session()->flush();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->route('login');
    }
}
