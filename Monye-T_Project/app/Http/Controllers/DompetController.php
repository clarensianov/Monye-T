<?php

namespace App\Http\Controllers;

use App\Models\Dompet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class DompetController extends Controller
{
    // Tambah Dompet
    public function inputDompet(Request $req)
    {
        try {
            $req->validate([
                'namaDompet' => 'string|required', 
                'saldoAwal' => 'required'
            ], [
                'namaDompet.required' => 'Nama Dompet wajib diisi', 
                'saldoAwal' => 'Saldo Awal wajib diisi'
                // jumlah_uang (DB) = saldo awal (CODE)
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }

        $data = [
            'nama_dompet' => $req->namaDompet, 
            'jumlah_uang' => $req->saldoAwal, 
            'user_id' => Auth::user()->user_id
        ];

        $kantung = Dompet::create($data);
        // dd($kantung);

        return redirect()->route('dashboard')->with('success', 'Dompet berhasil ditambahkan!');
    }

    public function getDompet()
    {
        
    }
}
