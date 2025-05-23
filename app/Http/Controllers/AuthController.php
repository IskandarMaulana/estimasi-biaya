<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Menampilkan form login
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Melakukan proses login
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);
        // dd( Hash::make($request->password));

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);

            session([
                'id_user' => $user->id_user,
                'nama' => $user->nama,
                'role' => $user->role,
                'logged_in' => true
            ]);

            return redirect()->route('dashboard.index')
                ->with('success', 'Login berhasil!');
        }

        return back()
            ->withInput($request->only('username'))
            ->withErrors(['login_error' => 'Username atau password salah!']);
    }

    /**
     * Melakukan proses logout
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Anda telah berhasil logout.');
    }

    /**
     * Redirect jika user mencoba akses halaman tertentu tanpa login
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unauthorized()
    {
        return redirect('/login')
            ->with('error', 'Anda harus login terlebih dahulu!');
    }
}