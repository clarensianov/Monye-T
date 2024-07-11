<?php

namespace App\Http\Controllers;

use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PencatatanController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $pencatatans = $user->pencatatans;

        // dd($pencatatans);

        return view('pencatatan', compact('user', 'pencatatans'));
    }
}
