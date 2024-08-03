<?php

namespace App\Http\Controllers;

use App\Models\Dompet;
use App\Models\Pencatatan;
use App\Models\User;
use Carbon\Carbon;
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

        $dompet =Dompet::create($data);

        if($req->saldoAwal > 0)
        {
            $filename = null;
            Pencatatan::create([
                'users_id' => auth()->user()->user_id,
                'kategoris_id' => 1,
                'dompets_id' => $dompet->dompet_id,
                'status' => "Pemasukan",
                'jumlah' => $req->saldoAwal,
                'deskripsi' => "Saldo Awal",
                'bukti' => $filename,
                'tanggal' => Carbon::today()
            ]);
        }

        return redirect()->route('dashboard')->with('success', 'Dompet berhasil ditambahkan!');
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

        // Selisih saldo dompet sebelumnya dengan terbaru
        $transaksi_jumlah = abs($dompet->jumlah_uang - $req->saldoDompet);
        $filename = null;

        // Kalau update saldo dompet jadi lebih besar (dicatat jadi pemasukan)
        if($req->saldoDompet > $dompet->jumlah_uang)
        {
            Pencatatan::create([
                'users_id' => auth()->user()->user_id,
                'kategoris_id' => 8,
                'dompets_id' => $dompet->dompet_id,
                'status' => "Pemasukan",
                'jumlah' => $transaksi_jumlah,
                'deskripsi' => "Penyesuaian Saldo",
                'bukti' => $filename,
                'tanggal' => Carbon::today()
            ]);
        } elseif($req->saldoDompet < $dompet->jumlah_uang)
        {
            Pencatatan::create([
                'users_id' => auth()->user()->user_id,
                'kategoris_id' => 8,
                'dompets_id' => $dompet->dompet_id,
                'status' => "Pengeluaran",
                'jumlah' => $transaksi_jumlah,
                'deskripsi' => "Penyesuaian Saldo",
                'bukti' => $filename,
                'tanggal' => Carbon::today()
            ]);
        }

        $dompet->update($data);

        return redirect()->route('dashboard')->with('success', 'Dompet berhasil diedit!');
    }
}
