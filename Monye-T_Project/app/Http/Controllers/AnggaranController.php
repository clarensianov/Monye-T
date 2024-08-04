<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Kategori;
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

        $pencatatan_user = $user->pencatatans;
        $digunakan = 0;
        $tx_count = 0;
        $status = false;
        foreach ($pencatatan_user as $pencatatan) {
            if($pencatatan->tanggal >= $req->tanggal_pembuatan && $pencatatan->tanggal <= $req->tanggal_berakhir){
                if($pencatatan->kategoris_id == $req->kategori && $pencatatan->status == "Pengeluaran"){
                    $digunakan += $pencatatan->jumlah;
                    $tx_count += 1;
                    $status = false;
                }
            }
        }

        Budget::create([
            'users_id' => $user->user_id,
            'kategoris_id' => $req->kategori,
            'nama_budget' => $req->NamaAnggaran,
            'jumlah' => $req->saldo,
            'tanggal_pembuatan' => $req->tanggal_pembuatan,
            'tanggal_berakhir' => $req->tanggal_berakhir,
            'status' => $status,
            'digunakan' => $digunakan,
            'tx_count' => $tx_count
        ]);

        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil dibuat.');
    }

    public function edit(Request $req){
        try{
            $req->validate([
                'saldo' => 'numeric',
            ], [
                'saldo.numeric' => 'Harap isi saldo dengan numeric'
            ]);
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }

        $budget = Budget::findOrFail($req->budget_id);
        if($req->NamaAnggaran){
            $budget->nama_budget = $req->NamaAnggaran;
        }

        if($req->saldo){
            $budget->jumlah = $req->saldo;
        }

        //HARUS DISESUAIKAN LAGI
        if($req->kategori){
            $budget->kategoris_id = $req->kategori;
        }

        if($req->tanggal_berakhir){
            $tanggalBerakhirReq = Carbon::parse($req->tanggal_berakhir);
            $tanggalBerakhirBudget = Carbon::parse($budget->tanggal_berakhir);
            if($tanggalBerakhirReq < $tanggalBerakhirBudget){
                return back()->withErrors('Tanggal berakhir harus masuk akal!')->withInput();
            }
            $budget->tanggal_berakhir = $req->tanggal_berakhir;
        }

        [$budget->tx_count, $budget->digunakan] = $this->updateDigunakanBudget($budget);

        $budget->save();

        return redirect()->route('anggaran.index')->with('success', 'Anggaran berhasil diubah.');
    }

    private function updateDigunakanBudget($budget)
    {
        $kategori = Kategori::findOrFail($budget->kategoris_id);
        $tx_count = 0;
        $digunakan = 0;

        foreach($kategori->pencatatans as $pencatatan)
        {
            if($pencatatan->tanggal >= $budget->tanggal_pembuatan && $pencatatan->tanggal <= $budget->tanggal_berakhir)
            {
                $tx_count += 1;
                $digunakan += $pencatatan->jumlah;
            }
        }

        return [$tx_count, $digunakan];
    }

    public function destroy(Request $req){
        $budget = Budget::findOrFail($req->budget_id);

        // Kalau udah ada transaksi, gbs dihapus
        if($budget->tx_count > 0)
        {
            return back()->with('error', 'Anggaran tidak dapat dihapus karena telah memiliki transaksi.');
        }

        $budget->delete();

        return back()->with('success', 'Anggaran berhasil dihapus.');
    }

    public function budgetData($id)
    {
        $budget = Budget::find($id);

        if (!$budget) {
            return response()->json(['error' => 'Budget not found'], 404);
        }
        // session()->flash('budgetKategori', $budget->kategoris_id);
        $kategori = Kategori::find($budget->kategoris_id);
        return response()->json([$budget, $kategori]);
    }
}
