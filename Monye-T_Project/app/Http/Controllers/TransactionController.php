<?php

namespace App\Http\Controllers;

use App\Models\Dompet;
use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TransactionController extends Controller
{
    public function inputTransaction(Request $req, $id){        
        try{
            $req->validate([                
                'tujuan' => 'required',
                'nominal' => 'required|numeric',                                
                'deskripsi' => 'nullable',
                'bukti' => 'nullable',            // |file|mimes:jpg,png,pdf|max:2048
                'tanggal' => 'required', //|date_format:m/d/Y
                'dompet' => 'required|exists:dompets,dompet_id',
                'kategori' => 'required',
            ], [
                'tujuan.required' => 'Harap set peruntukkannya',
                'nominal.required' => 'Harap isi nominalnya',  
                'nominal.numeric' => 'Nominal harus berupa angka',                              
                // 'bukti.file' => 'File bukti harus berupa file',
                // 'bukti.mimes' => 'File bukti harus berupa file dengan format jpg, png, atau pdf',
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

        // dd($req);
        
        $buktiPath = null;
        if ($req->hasFile('bukti')) {
            $buktiPath = $req->file('bukti')->store('bukti', 'public');
        }
        
        Pencatatan::create([
            'users_id' => $id,
            'kategoris_id' => $req->kategori,
            'dompets_id' => $req->dompet,
            'status' => $req->tujuan,
            'jumlah' => $req->nominal,
            'deskripsi' => $req->deskripsi,
            'bukti' => $buktiPath,
            'tanggal' => $req->tanggal
        ]);

        $dompet = Dompet::find($req->dompet);
        if($req->tujuan == 'Pemasukkan'){ //pemasukkan
            $dompet->jumlah_uang += $req->nominal;
        }
        else if($req->tujuan == 'Pengeluaran'){ //pengeluaran
            $dompet->jumlah_uang -= $req->nominal;
        }
        $dompet->save();

        return back()->with('success', 'Transaksi berhasil disimpan.');
    }
}
