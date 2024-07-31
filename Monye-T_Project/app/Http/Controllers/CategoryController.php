<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Kategori;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    public function store(Request $req)
    {
        try{
            $req->validate([
                'name' => 'required'
            ], [
                'name.required' => 'Nama kategori harus diisi!'
            ]);
        }catch(ValidationException $e){
            return back()->withErrors($e->errors())->withInput();
        }

        $kategoris = auth()->user()->kategoris;

        foreach ($kategoris as $kategori) {
            if($kategori->nama_kategori == $req->name){
                return back()->withErrors('Nama kategori harus unik!')->withInput();
            }
        }

        Kategori::create([
            'users_id' => auth()->user()->user_id,
            'nama_kategori' => $req->name
        ]);

        return back()->with('success', 'Kategori baru berhasil ditambahkan');
    }

    public function update(Request $req)
    {
        $kategori = Kategori::findOrFail($req->kategori_id);

        if($req->nama_kategori){
            $kategori->nama_kategori = $req->nama_kategori;
        }

        $kategori->save();

        return back()->with('success', 'Kategori berhasil diupdate');
    }
}

