<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rawi extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'halalrawi',
    ];

    // 🔗 العلاقات
    public function hadiths()
    {
        return $this->hasMany(Hadith::class, 'narrator_id');
    }
}

