<?php

namespace App\Http\Controllers;

use App\Models\Dompet;
use App\Models\Pencatatan;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

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

        $filename = null;
        if ($req->hasFile('bukti')) {
            $file = $req->file('bukti');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
        }

        Pencatatan::create([
            'users_id' => auth()->user()->user_id,
            'kategoris_id' => $req->kategori,
            'dompets_id' => $req->dompet,
            'status' => $req->tujuan,
            'jumlah' => $req->nominal,
            'deskripsi' => $req->deskripsi,
            'bukti' => $filename,
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

        $user = auth()->user();
        $budget_user = $user->budgets;
        if($req->tujuan == 'Pengeluaran'){
            foreach ($budget_user as $budget) {
                if ($budget->kategoris_id == $req->kategori && $budget->status == false){
                    if($budget->tx_status == false){
                        $budget->tx_status = true;
                    }
                    $budget->digunakan += $req->nominal;
                    $budget->save();
                    break;
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function editTransaction(Request $req){
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

        $transaction = Pencatatan::findOrFail($req->pencatatan_id);
        // dd($transaction);

        $filename = null;
        if ($req->hasFile('bukti')) {
            if ($req->file('bukti') != $transaction->bukti)
            {
                $file = $req->file('bukti');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
            }
                $filename = $req->file('bukti');
        }

        $data = [
            'kategoris_id' => $req->kategori,
            'dompets_id' => $req->dompet,
            'status' => $req->tujuan,
            'jumlah' => $req->nominal,
            'deskripsi' => $req->deskripsi,
            'bukti' => $filename,
            'tanggal' => $req->tanggal
        ];

        $transaction->update($data);

        $dompet = Dompet::find($req->dompet);
        if($req->tujuan == 'Pemasukan'){ //pemasukkan
            $dompet->jumlah_uang += $req->nominal;
        }
        else if($req->tujuan == 'Pengeluaran'){ //pengeluaran
            $dompet->jumlah_uang -= $req->nominal;
        }
        $dompet->save();

        $user = auth()->user();
        $budget_user = $user->budgets;
        if($req->tujuan == 'Pengeluaran'){
            foreach ($budget_user as $budget) {
                if ($budget->kategoris_id == $req->kategori && $budget->status == false){
                    if($budget->tx_status == false){
                        $budget->tx_status = true;
                    }
                    $budget->digunakan += $req->nominal;
                    $budget->save();
                    break;
                }
            }
        }

        return redirect()->route('dashboard')->with('success', 'Transaksi berhasil diedit.');
    }

    public function deleteTransaction(Request $req)
    {
        $pencatatan = Pencatatan::findOrFail($req->pencatatan_id);
        $pencatatan->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
}
