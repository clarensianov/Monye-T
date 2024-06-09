<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index(){
        return view('loginregister');
    }

    public function login(Request $req){
        $req->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'password.required' => 'Password wajib diisi'
        ]);

        $login = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (Auth::attempt($login)) {
            $req->session()->regenerate();
            return redirect()->intended('/dashboard');
        } 

        return back()->with('loginFailed', 'Gagal Login');
    }

    public function register(Request $req){
        Session::flash('namaDepan', $req->namaDepan);
        Session::flash('namaBelakang', $req->namaBelakang);
        Session::flash('email', $req->email);
        Session::flash('username', $req->username);

        $req->validate([
            'namaDepan' => 'required',
            'namaBelakang' => 'required',
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => 'required|min:8'
        ], [
            'namaDepan.required' => 'Nama Depan wajib diisi',
            'namaBelakang.required' => 'Nama Belakang wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Email harus sesuai format',
            'email.unique' => 'Email sudah pernah terdaftar, silahkan coba email yang lain',
            'username.required' => 'Username wajib diisi',
            'username.unique' => 'Username tidak tersedia/sudah digunakan',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimum password adalah 8 karakter'
        ]);

        $data = [
            'nama' => $req->namaDepan . ' ' . $req->namaBelakang,
            'email' => $req->email,
            'username' => $req->username,
            'password' => Hash::make($req->password)
        ];
        $data = User::create($data);

        $login = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (Auth::attempt($login)) {
            $req->session()->regenerate();
            return redirect()->route('katapemulihan')->with('userData', $data->user_id);
        }

        dd('gagal');
    }

    public function katapemulihan(Request $req, $id){        
        $req->validate([
            'katapemulihan' => 'required'
        ], [
            'katapemulihan.required' => 'Kata Pemulihan wajib diisi'
        ]);

        $user = User::where('user_id', '=', $id)->first();
        $user->kata_pemulihan = $req->input('katapemulihan');
        $user->save();

        return redirect('/dashboard');
    }

    public function lupasandi(Request $req){
        $req->validate([
            'email' => 'required|email',
            'kata_pemulihan' => 'required'
        ],[
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak sesuai',
            'kata_pemulihan.required' => 'Kata Pemulihan wajib diisi'
        ]);

        $user = User::where('email', $req->email)->where('kata_pemulihan', $req->kata_pemulihan)->first();

        if($user){                        
            return redirect('/inputsandi')->with('user', $user->user_id);
        }

        return redirect('/lupasandi')->with('error', 'Email/Kata pemulihan tidak tersedia ataupun cocok');
    }

    public function inputsandi(Request $req, $id){
        $req->validate([
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required'
        ],[
            'password.confirmed' => 'Password berbeda',
            'password.min' => 'Password minimal 8 karakter'
        ]);

        $user = User::find($id);

        if($user){
            $user->password = Hash::make($req->password);
            $user->save();
            return redirect('/loginregister')->with('success_pass', 'Perubahan password berhasil!');
        }

        dd('gagal?!?');
    }

    public function logout(Request $req){
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerateToken();
        return redirect('/loginregister');
    }
}
