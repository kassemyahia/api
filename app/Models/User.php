<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'birth_date',
        'gender'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
    public function favorites()
    {
        return $this->belongsToMany(
            Hadith::class,
            'favorites',   // اسم جدول المفضلة
            'user_id',     // العمود الذي يشير للمستخدم
            'hadith_id'    // العمود الذي يشير للحديث
        );
    }


}
