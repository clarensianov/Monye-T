<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
            'current-password' => 'required_with:new-password|string|min:8',
                'new-password' => 'required_with:current-password|string|confirmed|min:8',
        ]);

        // Update Username
        if ($req->filled('username')) {
            $user->username = $req->input('username');
        }

        // Validate password fields only if password fields are present
        
        $passwordUpdated = false;
        if ($req->filled('current-password') || $req->filled('new-password')) {
            $req->validate([
                'current-password' => 'required_with:new-password|string|min:8',
                'new-password' => 'required_with:current-password|string|confirmed|min:8',
            ]);

            // Validate & Update password
            if ($req->filled('current-password') && $req->filled('new-password')) {
                if (!Hash::check($req->input('current-password'), $user->password)) {
                    return redirect()->route('profile.index')->withErrors(['current-password' => 'Password sekarang salah']);
                }
                dump('anjay');
                $user->password = Hash::make($req->input('new-password'));
                $passwordUpdated = true;
            }
        }

        // dd($user->password);
        // dd($req->input('passwordSekarang'));

        $user->save();

        if ($passwordUpdated) {
            return redirect()->route('profile.index')->with('success', 'Akun berhasil diperbaharui!');
        } else {
            return redirect()->route('profile.index')->with('success', 'Username berhasil diperbaharui!');
        }

    }


}
