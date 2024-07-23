<?php

namespace App\Http\Controllers;

use App\Models\Pencatatan;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

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

        // $pencatatans = auth()->user()->pencatatans()
        // ->join('dompets', 'pencatatans.dompets_id', '=', 'dompets.dompet_id')
        // ->join('kategoris', 'pencatatans.kategoris_id', '=', 'kategoris.kategori_id')
        // ->select('pencatatans.*', 'dompets.nama_dompet', 'kategoris.nama_kategori');

        // TODO: BELUM KELARRRRRRRRRR :)
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
}
