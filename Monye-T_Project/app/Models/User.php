<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'nama',
        'username',
        'email',
        'password',
        'gambar_user',
        'kata_pemulihan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function budgets(): HasMany{
        return $this->hasMany(Budget::class, "users_id");
    }

    public function dompets(): HasMany{
        return $this->hasMany(Dompet::class, "users_id");
    }

    public function kategoris(): HasMany{
        return $this->hasMany(Kategori::class, "users_id");
    }

    public function pencatatans(): HasMany{
        return $this->hasMany(Pencatatan::class, "users_id");
    }

    public function pencatatan_grups(): HasMany{
        return $this->hasMany(Pencatatan_Grup::class, "users_id");
    }

    public function grup_users(): HasMany{
        return $this->hasMany(Grup_User::class, "users_id");
    }
}
