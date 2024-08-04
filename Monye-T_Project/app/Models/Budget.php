<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Budget extends Model
{
    use HasFactory;

    protected $primaryKey = 'budget_id';

    protected $fillable = [
        'users_id',
        'kategoris_id',
        'nama_budget',
        'jumlah',
        'tanggal_pembuatan',
        'tanggal_berakhir',
        'digunakan',
        'tx_count',
        'status'
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'users_id', 'user_id');
    }

    public function kategoris(): BelongsTo{
        return $this->belongsTo(Kategori::class, 'kategoris_id', 'kategori_id');
    }
}
