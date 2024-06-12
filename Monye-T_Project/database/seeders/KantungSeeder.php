<?php

namespace Database\Seeders;

use App\Models\Kantung;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;

class KantungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kantung::create([
        //     'nama_kantung' => 'BCA',
        //     'jumlah_uang' => 200000, 
        //     'user_id' => 1
        // ]);

        Kantung::create([
            'nama_kantung' => 'Blu',
            'jumlah_uang' => 100000, 
            'user_id' => 1
        ]);

        Kantung::create([
            'nama_kantung' => 'NeoBank',
            'jumlah_uang' => 500000, 
            'user_id' => 1
        ]);

        Kantung::create([
            'nama_kantung' => 'Jago',
            'jumlah_uang' => 200000, 
            'user_id' => 1
        ]);
    }
}
