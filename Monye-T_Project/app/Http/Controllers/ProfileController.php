<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
        $user = Auth::user();

        return view('profile');
    }

    public function updateProfile(Request $req)
    {
        $user = Auth::user();

        if (!$user instanceof User) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }

        // Validate username field
        $req->validate([
            'username' => 'string|required',
            'current-password' => 'nullable|string|min:8|required_with:new-password',
            'new-password' => 'nullable|string|min:8|required_with:current-password',
            'profile-image' => 'mimes:jpeg,png,jpg',
        ], [
            'current-password.min' => 'Minimum password adalah 8 karakter',
            'new-password.min' => 'Minimum password adalah 8 karakter',
            'current-password.required_with' => 'Tolong isi Password Sekarang Anda!',
            'new-password.required_with' => 'Tolong isi Password Baru Anda!',
        ]);

        // Update Username
        if ($req->username != null) {
            $user->username = $req->username;
        }

        // Validate & Update password
        if ($req->filled('current-password') && $req->filled('new-password')) {
            // dd(1);
            if (!Hash::check($req->input('current-password'), $user->password)) {
                return redirect()->route('profile.index')->with('error', 'Password sekarang yang Anda masukkan salah! Coba lagi!');
            }
            $user->password = Hash::make($req->input('new-password'));
        }

        if ($req->hasFile('profile-image')) {
            $file = $req->file('profile-image');
            $file = $req->file('profile-image')->move('profile-image',$req->file('profile-image')->getClientOriginalName());
            $user->gambar_user = $file;
        }



        $user->save();

        return redirect()->route('profile.index')->with('success', 'Perubahan berhasil disimpan!');

    }


}
