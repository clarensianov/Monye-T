<?php

namespace App\Http\Controllers;

use App\Models\Dompet;
use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function inputTransaction(Request $req){
        try{
            $req->validate([
                'tujuan' => 'required',
                'nominal' => 'required|numeric',
                'deskripsi' => 'nullable',
                'bukti' => 'nullable|mimes:jpg,png,pdf',
                'tanggal' => 'required', //|date_format:m/d/Y
                'dompet' => 'required|exists:dompets,dompet_id',
                'kategori' => 'required',
            ], [
                'tujuan.required' => 'Harap set peruntukkannya',
                'nominal.required' => 'Harap isi nominalnya',
                'nominal.numeric' => 'Nominal harus berupa angka',
                // 'bukti.file' => 'File bukti harus berupa file',
                'bukti.mimes' => 'File bukti harus berupa file dengan format jpg, png, atau pdf',
                // 'bukti.max' => 'File bukti tidak boleh lebih dari 2MB',
                'tanggal.required' => 'Harap set tanggal',
                // 'tanggal.date_format' => 'Tanggal tidak valid, harus dalam format mm/dd/yyyy',
                'dompet.required' => 'Harap pilih dompet',
                'dompet.exists' => 'Dompet tidak ditemukan',
                'kategori.required' => 'Harap pilih kategori',
            ]);
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }
        $path = null;
        if ($req->hasFile('bukti')) {
            $file = $req->file('bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename);
        }

        Pencatatan::create([
            'users_id' => auth()->user()->user_id,
            'kategoris_id' => $req->kategori,
            'dompets_id' => $req->dompet,
            'status' => $req->tujuan,
            'jumlah' => $req->nominal,
            'deskripsi' => $req->deskripsi,
            'bukti' => $path,
            'tanggal' => $req->tanggal
        ]);

        $dompet = Dompet::find($req->dompet);
        if($req->tujuan == 'Pemasukan'){ //pemasukkan
            $dompet->jumlah_uang += $req->nominal;
        }
        else if($req->tujuan == 'Pengeluaran'){ //pengeluaran
            $dompet->jumlah_uang -= $req->nominal;
        }
        $dompet->save();

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan.');
    }
}
