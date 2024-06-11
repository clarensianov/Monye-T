<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseFormatter;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $req){
        try{
            $req->validate([
                'email' => 'required',
                'password' => 'required'
            ], [
                'email.required' => 'Email wajib diisi',
                'password.required' => 'Password wajib diisi'
            ]);            
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }

        $login = [
            'email' => $req->email,
            'password' => $req->password
        ];

        if (Auth::attempt($login)) {
            $req->session()->regenerate();
            
            // $user = User::where('email', $req->email)->first();
            // $req->session()->put('nama', $user->nama);
            // dd(session('nama'));
            return redirect()->intended('/dashboard');
        } 

        return back()->with('loginFailed', 'Gagal Login');
    }

    public function register(Request $req){
        Session::flash('namaDepan', $req->namaDepan);
        Session::flash('namaBelakang', $req->namaBelakang);
        Session::flash('email', $req->email);
        Session::flash('username', $req->username);

        try{
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
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }

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
        try{
            $req->validate([
                'katapemulihan' => 'required'
            ], [
                'katapemulihan.required' => 'Kata Pemulihan wajib diisi'
            ]);
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }

        $user = User::where('user_id', '=', $id)->first();
        $user->kata_pemulihan = $req->input('katapemulihan');
        $user->save();

        return redirect('/dashboard');
    }

    public function lupasandi(Request $req){
        try{
            $req->validate([
                'email' => 'required',
                'katapemulihan' => 'required'
            ],[
                'email.required' => 'Email wajib diisi',                
                'katapemulihan.required' => 'Kata Pemulihan wajib diisi'
            ]);
        }catch(ValidationException $e){                        
            return back()->withErrors($e->errors())->withInput();
        }

        $user = User::where('email', $req->email)->where('kata_pemulihan', $req->katapemulihan)->first();        
        if($user){                    
            return redirect('/inputsandi')->with('user', $user->user_id);
        }        

        return back()->with('error', 'Email/Kata pemulihan tidak tersedia ataupun cocok');
    }

    public function inputsandi(Request $req, $id){
        try{
            $req->validate([
                'password' => 'required|confirmed|min:8',
                'password_confirmation' => 'required'
            ],[
                'password.confirmed' => 'Password konfirmasi berbeda',
                'password.min' => 'Password minimal 8 karakter',
                'password.required' => 'Password harus diisi'
            ]);
        }catch(ValidationException $e){
            return back()->with('user', $id)->withErrors($e->errors())->withInput();
        }
        
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
