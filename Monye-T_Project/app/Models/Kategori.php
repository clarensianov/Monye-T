<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Kategori extends Model
{
    use HasFactory;

    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'users_id',
        'nama_kategori'
    ];

    public function users(): BelongsTo{
        return $this->belongsTo(User::class, 'users_id', 'user_id');
    }

    public function pencatatans(): HasMany{
        return $this->hasMany(Pencatatan::class, 'kategoris_id', 'kategori_id');
    }

    public function budgets(): HasOne{
        return $this->hasOne(Budget::class, 'budgets_id', 'budget_id');
    }
}
