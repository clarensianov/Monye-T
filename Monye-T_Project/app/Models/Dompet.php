<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dompet extends Model
{
    use HasFactory;

    protected $primaryKey = 'dompet_id';

    protected $fillable = [
        'nama_dompet',
        'jumlah_uang',
        'users_id'
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'users_id');
    }

    public function pencatatans(): HasMany{
        return $this->hasMany(Pencatatan::class);
    }
}
