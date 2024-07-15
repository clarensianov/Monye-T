<?php

namespace Database\Factories;

use App\Models\Dompet;
use App\Models\Kategori;
use App\Models\Pencatatan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pencatatan>
 */
class PencatatanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Pencatatan::class;

    public function definition(): array
    {
        $kategoris = Kategori::all();
        $kategoris = $kategoris->count();

        $dompets = Dompet::all();
        $dompets = $dompets->count();

        $status = ["Pemasukan", "Pengeluaran"];

        return [
            'tanggal' => $this->faker->date(),
            'users_id' => 1,
            'kategori_id' => $this->faker->numberBetween(1, $kategoris),
            'kantung_id'=> $this->faker->numberBetween(1, $dompets),
            'status' => $status[$this->faker->numberBetween(0, 1)],
            'jumlah' => $this->faker->numberBetween(50000, 200000),
            'bukti' => "none",
            'deskripsi' => $this->faker->sentence()
        ];
    }
}
