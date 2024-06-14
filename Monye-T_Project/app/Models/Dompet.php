<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Dompet extends Model
{
    use HasFactory;

    protected $primaryKey = 'dompet_id';
    
    protected $fillable = [
        'nama_dompet',
        'jumlah_uang',
        'user_id'
    ];     

    public function users(): HasOne{
        return $this->hasOne(User::class, 'user_id');
    }
}
