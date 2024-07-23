<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AnggaranController extends Controller
{
    public function index(){
        $user = auth()->user();
        $budget_user = $user->budgets;
        $today = Carbon::today();
        
        foreach ($budget_user as $budget) {
            if($budget->status == false){
                if($budget->tanggal_berakhir < $today){
                    $budget->status = true;
                    $budget->save();
                }
            }
        }
        return view('AnggaranAktif');
    }

    public function nonIndex(){
        return view('AnggaranNonAktif');
    }

    public function create(Request $req){
        //NamaAnggaran, saldo, kategori, tanggal_pembuatan, tanggal_berakhir
        try{
            $req->validate([
                'NamaAnggaran' => 'required',
                'saldo' => 'required|numeric',
                'tanggal_pembuatan' => 'required|date|', //after_or_equal:today
                'tanggal_berakhir' => 'required|date|after:tanggal_pembuatan'
            ], [
                'NamaAnggaran.required' => 'Harap set nama anggaran',
                'saldo.required' => 'Harap isi nominalnya',
                'saldo.numeric' => 'Harap isi saldo dengan numeric',
                'tanggal_pembuatan' => 'Harap isi tanggal',
                // 'tanggal_pembuatan.after_or_equal' => 'Pemilihan tanggal mulai setidaknya hari ini',
                'tanggal_berakhir' => 'Harap isi tanggal',
                'tanggal_berakhir.after' => 'Pemilihan tanggal tidak logis'
            ]);
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }
        
        $user = auth()->user();
        $budget_user = $user->budgets;
        
        foreach ($budget_user as $budget) {
            if($budget->kategoris_id == $req->kategori && $budget->tanggal_berakhir >= $req->tanggal_pembuatan){
                if($budget->status == false){
                    return back()->withErrors('Anggaran untuk kategori yang anda pilih sudah ada dan masih berlangsung');
                }
            }
        }

        Budget::create([
            'users_id' => $user->user_id,
            'kategoris_id' => $req->kategori,
            'nama_budget' => $req->NamaAnggaran,
            'jumlah' => $req->saldo,
            'tanggal_pembuatan' => $req->tanggal_pembuatan,
            'tanggal_berakhir' => $req->tanggal_berakhir
        ]);

        return redirect()->route('anggaran')->with('success', 'Anggaran berhasil dibuat.');
    }


}
