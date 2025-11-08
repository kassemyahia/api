<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Explaining extends Model
{
    use HasFactory;

    protected $fillable = [
        'ETEXT',
    ];

    // 🔗 العلاقات
    public function hadiths()
    {
        return $this->hasMany(Hadith::class, 'explaining_id');
    }
}
