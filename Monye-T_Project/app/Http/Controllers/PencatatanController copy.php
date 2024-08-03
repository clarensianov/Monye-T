<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Pencatatan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use App\Models\Category;
use App\Models\Dompet;
use App\Models\Kategori;
use Illuminate\Validation\ValidationException;

class PencatatanController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $pencatatans = $user->pencatatans;

        if(request()->ajax())
        {
            return DataTables::of($pencatatans)
            ->addColumn('action', 'pencatatan_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        // $user = Auth::user();
        // $pencatatans = $user->pencatatans;

        return view('pencatatan', compact('pencatatans'));
    }

    // Untuk data table (View semua transaksi user)
    public function fetchData(Request $request)
   {
    $pencatatans = DB::table('pencatatans')
    ->join('dompets', 'pencatatans.dompets_id', '=', 'dompets.dompet_id')
    ->join('kategoris', 'pencatatans.kategoris_id', '=', 'kategoris.kategori_id')
    ->select(
        'pencatatans.*',
        'dompets.nama_dompet',
        'kategoris.nama_kategori'
    )
    ->where('pencatatans.users_id', auth()->id());

        // TODO: BELUM KELARRRRRRRRRR (Front End kereset, tapi backend g):)
        if ($request->filled('fromdate')) {
            $pencatatans->where('tanggal', '>=', $request->fromdate);
        }

        if ($request->filled('todate')) {
            $pencatatans->where('tanggal', '<=', $request->todate);
        }

        if ($request->filled('dompet_filter') && $request->dompet_filter != 'Dompet') {
            $pencatatans->where('dompet_id', '=', $request->dompet_filter);
        }

        if ($request->filled('kategori_filter') && $request->kategori_filter != 'Kategori') {
            $pencatatans->where('kategori_id', '=', $request->kategori_filter);
        }

        if ($request->filled('status_filter') && $request->status_filter != 'Status') {
            $pencatatans->where('status', '=', $request->status_filter);
        }

        return DataTables::of($pencatatans)
        ->addColumn('action', 'pencatatan_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
    }

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

        $filename = null;
        if ($req->hasFile('bukti')) {
            if ($req->file('bukti') != $transaction->bukti)
            {
                $file = $req->file('bukti');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
            } else {
                $filename = $transaction->bukti;
            }
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
        $kategori = Kategori::find($req->kategori);

        // TODO:STATUS G BOLEH BERUBAH :)
        if($req->tujuan == 'Pemasukan'){ //pemasukan
            // Dompetnya berubah
            if($dompet->dompet_id != $transaction->dompets_id){
                // Dompet sekarang
                $dompet->jumlah_uang += $req->nominal;

                // Dompet lama
                $dompet_old = Dompet::findOrFail($transaction->dompets_id);
                $dompet_old->jumlah_uang -= $transaction->jumlah;
            } else {
                // Dompet tidak berubah
                $dompet->jumlah_uang = $dompet->jumlah_uang - $transaction->jumlah + $req->nominal;
            }
        }
        else if($req->tujuan == 'Pengeluaran'){ //pengeluaran
            if($dompet->dompet_id != $transaction->dompets_id){
                // Dompet sekarang
                $dompet->jumlah_uang -= $req->nominal;

                // Dompet lama
                $dompet_old = Dompet::findOrFail($transaction->dompets_id);
                $dompet_old->jumlah_uang += $transaction->jumlah;
            } else {
                // Dompet tidak berubah
                $dompet->jumlah_uang = $dompet->jumlah_uang + $transaction->jumlah - $req->nominal;
            }
        }
        $dompet->save();

        // TODO:budget ribet YA TUHAN
        $user = auth()->user();
        $budget_user = $user->budgets;
        if($req->tujuan == 'Pengeluaran'){

            // Kategori udah ada budget atau belum, aktif atau tidak

            // foreach ($budget_user as $budget) {
            //     if ($budget->kategoris_id == $req->kategori && $budget->status == false){
            //         if($budget->tx_status == false){
            //             $budget->tx_status = true;
            //         }
            //         $budget->digunakan = $budget->digunakan + $transaction->jumlah - $req->nominal;
            //         $budget->save();
            //         break;
            //     }

            //     if ($budget->kategoris_id == $req->kategori && $budget->status == false){
            //         if($budget->tx_status == false){
            //             $budget->tx_status = true;
            //         }
            //         $budget->digunakan = $budget->digunakan + $transaction->jumlah - $req->nominal;
            //         $budget->save();
            //         break;
            //     }
            // }
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
