<?php

namespace App\Http\Controllers;

use App\Models\Dompet;
use App\Models\User;
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
            'users_id' => Auth::user()->user_id
        ];

        Dompet::create($data);
        // dd($kantung);

        return redirect()->route('dashboard')->with('success', 'Dompet berhasil ditambahkan!');
        // return redirect()->route('dashboard', ['success' => 'Dompet berhasil']);

    }

    public function editDompet(Request $req)
    {

        try {
            $req->validate([
                'namaDompet' => 'string|required',
                'saldoDompet' => 'required'
            ], [
                'namaDompet.required' => 'Nama Dompet wajib diisi',
                'saldoDompet' => 'Saldo Awal wajib diisi'
                // jumlah_uang (DB) = saldo awal (CODE)
            ]);
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();

        }

        $data = [
            'nama_dompet' => $req->namaDompet,
            'jumlah_uang' => $req->saldoDompet,
            'users_id' => Auth::user()->user_id
        ];

        $dompet = Dompet::findOrFail($req->DompetID);
        $dompet->update($data);
        // dd($kantung);

        return redirect()->route('dashboard')->with('success', 'Dompet berhasil ditambahkan!');
    }
}
