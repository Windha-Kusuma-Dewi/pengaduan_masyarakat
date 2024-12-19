<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    //  public function login()
    //  {
    //      return view('login');
    //  }

    //    public function loginAuth(Request $request) 
    // {
    //     $request->validate([
    //         'email' => 'required|email',
    //         'password' => 'required|string|min:6', // Sesuaikan panjang password jika diperlukan
    //     ]);

    //     // Coba autentikasi pengguna
    //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
    //         // Login berhasil
    //         return redirect()->intended('report.article'); // Ganti dengan rute sesuai kebutuhan
    //     }

    //     // Login gagal
    //     // return redirect()->back()->with('error', 'Email atau password salah');
    // }
    
    public function login() {
        return view('login');
    } 

    public function loginAuth(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            return redirect()->route('report.article');
        } else {
            return redirect()->back()->with('failed', 'Login gagal');
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout!');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
