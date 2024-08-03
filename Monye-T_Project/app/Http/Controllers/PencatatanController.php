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

        // dd($req);

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
            // dd($dompet);
        }
        $dompet->save();

        $user = auth()->user();
        $budget_user = $user->budgets;
        if($req->tujuan == 'Pengeluaran'){
            foreach ($budget_user as $budget) {
                if ($budget->kategoris_id == $req->kategori && $budget->status == false){
                    if ($req->tanggal >= $budget->tanggal_pembuatan && $req->tanggal <= $budget->tanggal_berakhir)
                    {
                        $budget->tx_count += 1;
                        $budget->digunakan += $req->nominal;
                        $budget->save();
                        break;
                    }
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

        // Dompet & Kategori Lama
        $dompet_old = Dompet::findOrFail($transaction->dompets_id);

        // Dompet & Kategori Baru
        $dompet_new = Dompet::find($req->dompet);

        // Nominal Baru & Lama
        $old = $transaction->jumlah;
        $new = $req->nominal;

        // Asumsi nominal selalu berubah
        if ($req->tujuan != $transaction->status)
        {
            if($transaction->status == "Pemasukan" && $req->tujuan == "Pengeluaran")
            {
                // Dompet Berubah
                if($dompet_old->dompet_id != $dompet_new->dompet_id) {
                    $dompet_old->jumlah_uang -= $old;
                    $dompet_new->jumlah_uang -= $new;

                    $dompet_old->save();
                    $dompet_new->save();
                } else {
                    $dompet_old->jumlah_uang = $dompet_old->jumlah_uang - $old - $new;

                    $dompet_old->save();
                }
            } elseif ($transaction->status == "Pengeluaran" && $req->tujuan == "Pemasukan")
            {
                // Dompet Berubah
                if($dompet_old->dompet_id != $dompet_new->dompet_id) {
                    $dompet_old->jumlah_uang += $old;
                    $dompet_new->jumlah_uang += $new;

                    $dompet_old->save();
                    $dompet_new->save();
                } else {
                    $dompet_old->jumlah_uang = $dompet_old->jumlah_uang + $old + $new;

                    $dompet_old->save();
                }
            }
        } else {
            // Status tidak berubah

            // Pemasukan mempengaruhi Dompet
            if($req->tujuan == "Pemasukan")
            {
                // Dompet Berubah
                if($dompet_old->dompet_id != $dompet_new->dompet_id) {
                    $dompet_old->jumlah_uang -= $old;
                    $dompet_new->jumlah_uang += $new;

                    $dompet_old->save();
                    $dompet_new->save();
                } else {
                    $dompet_old->jumlah_uang = $dompet_old->jumlah_uang - $old + $new;

                    $dompet_old->save();
                }
            } else {
                // Dompet Berubah
                if($dompet_old->dompet_id != $dompet_new->dompet_id) {
                    $dompet_old->jumlah_uang += $old;
                    $dompet_new->jumlah_uang -= $new;

                    $dompet_old->save();
                    $dompet_new->save();
                } else {
                    $dompet_old->jumlah_uang = $dompet_old->jumlah_uang + $old - $new;

                    $dompet_old->save();
                }
            }
        }


        $this->updateBudgetTransaction($req, $transaction, $transaction->status, $req->tujuan, $transaction->kategoris_id, $req->kategori, $old, $new);

        $transaction->update($data);

        return back()->with('success', 'Transaksi berhasil diedit.');
    }

    private function updateBudgetTransaction($req, $transaction, $status_old, $status_new, $kategori_old, $kategori_new, $old, $new)
    {
        $user = auth()->user();
        $budget_user = $user->budgets;

        // Define budgets
        $budget_old = null;
        $budget_new = null;

        // Cari budget kategori old
        // Asumsi ambil 1 budget dari kategori old yang ketemu di rentang
        foreach ($budget_user as $budget) {
            if ($budget->kategoris_id == $kategori_old){
                // Transaksi tidak dalam range budget
                if ($transaction->tanggal >= $budget->tanggal_pembuatan && $transaction->tanggal <= $budget->tanggal_berakhir)
                {
                    $budget_old = $budget;
                    break;
                }
            }
        }

            // Cari budget kategori new (terlepas dari kategorinya sama atau g)
            // Asumsi ambil 1 budget dari kategori new yang ketemu di rentang
            foreach ($budget_user as $budget) {
                if ($budget->kategoris_id == $kategori_new){
                    // Transaksi tidak dalam range budget
                    if ($req->tanggal >= $budget->tanggal_pembuatan && $req->tanggal <= $budget->tanggal_berakhir)
                    {
                        $budget_new = $budget;
                        break;
                    }
                }
            }

        // Kalau budgetnya g nemu
        if($budget_old == null && $budget_new == null) return;

        // Status sama, kategori sama
        if($status_old == $status_new && $kategori_old == $kategori_new)
        {
            // Kalau tanggal old dalam range
            if($budget_old != null && $budget_new != null)
            {
                if($budget_old->digunakan == 0)
                {
                    $budget_old->digunakan = $budget_old->digunakan + $new;
                } else {
                    $budget_old->digunakan = $budget_old->digunakan - $old + $new;
                }

                $budget_old->save();
            } elseif ($budget_old != null) // Tanggal old dalam range, tanggal new g
            {
                $budget_old->digunakan = $budget_old->digunakan - $old;
                $budget_old->save();
            } else if ($budget_new != null) // Tanggal new dalam range, tanggal old g
            {
                $budget_new->digunakan = $budget_new->digunakan + $new;
                $budget_new->save();
            }
        } elseif($status_old == $status_new && $kategori_old != $kategori_new) // Status sama, kategori berubah
        {
            // Tanggal old dalam range
            if($budget_old != null)
            {
                $budget_old->tx_count -= 1;
                $budget_old->digunakan = $budget_old->digunakan - $old;
                $budget_old->save();
            }

            // Tanggal new dalam range
            if($budget_new != null)
            {
                $budget_new->tx_count += 1;
                $budget_new->digunakan = $budget_new->digunakan + $new;
                $budget_new->save();
            }
        } elseif($status_old != $status_new && $kategori_old == $kategori_new) // Status beda, kategori sama
        {
            if($status_old == "Pemasukan" && $status_new == "Pengeluaran")
            {
                // Kalau tanggal new dalam range
                if($budget_new != null)
                {
                    $budget_new->tx_count += 1;
                    $budget_new->digunakan = $budget_new->digunakan + $new;
                    $budget_new->save();
                }
            } elseif($status_old == "Pengeluaran" && $status_new == "Pemasukan")
            {
                // Tanggal old dalam range
                if($budget_old != null)
                {
                    $budget_old->tx_count -= 1;
                    $budget_old->digunakan = $budget_old->digunakan - $old;
                    $budget_old->save();
                }
            }
        } elseif($status_old != $status_new && $kategori_old != $kategori_new) // Status beda, kategori beda
        {
            if($status_old == "Pemasukan" && $status_new == "Pengeluaran")
            {
                // Tanggal new dalam range
                if($budget_new != null)
                {
                    $budget_new->tx_count += 1;
                    $budget_new->digunakan = $budget_new->digunakan + $new;
                    $budget_new->save();
                }
            } elseif($status_old == "Pengeluaran" && $status_new == "Pemasukan")
            {
                // Tanggal new dalam range
                if($budget_old != null)
                {
                    $budget_old->tx_count -= 1;
                    $budget_old->digunakan = $budget_old->digunakan - $old;
                    $budget_old->save();
                }
            }
        }

        return;
    }

    public function deleteTransaction(Request $req)
    {
        $pencatatan = Pencatatan::findOrFail($req->pencatatan_id);

        // Dompet
        $dompet = Dompet::findOrFail($pencatatan->dompets_id);

        // Asumsi nominal selalu berubah
        if ($pencatatan->status == "Pemasukan")
        {
            $dompet->jumlah_uang = $dompet->jumlah_uang - $pencatatan->jumlah;
        } elseif ($pencatatan->status == "Pengeluaran")
        {
            $dompet->jumlah_uang = $dompet->jumlah_uang + $pencatatan->jumlah;
            $this->updateBudgetTransactionOnDelete($pencatatan, $pencatatan->kategoris_id);
        }
        $dompet->save();

        $pencatatan->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }

    private function updateBudgetTransactionOnDelete($pencatatan, $kategori)
    {
        $user = auth()->user();
        $budget_user = $user->budgets;

        // Cari budget kategori
        // Asumsi ambil 1 budget dari kategori old yang ketemu di rentang
        foreach ($budget_user as $budget) {
            if ($budget->kategoris_id == $kategori){
                // Transaksi tidak dalam range budget
                if ($pencatatan->tanggal >= $budget->tanggal_pembuatan && $pencatatan->tanggal <= $budget->tanggal_berakhir)
                {
                    $budget->tx_count -= 1;
                    $budget->digunakan = $budget->digunakan - $pencatatan->jumlah;
                    $budget->save();
                    break;
                }
            }
        }

        return;
    }
}
