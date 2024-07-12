<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    protected $model = Kategori::class;

    public function run(): void
    {
        Kategori::create([
            'nama_kategori' => 'Pendidikan',
            'users_id' => 1
        ]);

        Kategori::create([
            'nama_kategori' => 'Kesehatan',
            'users_id' => 1
        ]);

        Kategori::create([
            'nama_kategori' => 'Liburan',
            'users_id' => 1
        ]);

        Kategori::create([
            'nama_kategori' => 'Hiburan',
            'users_id' => 1
        ]);

        Kategori::create([
            'nama_kategori' => 'Kebutuhan Rumah',
            'users_id' => 1
        ]);
    }
}
