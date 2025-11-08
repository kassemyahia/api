<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Narrator extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'narratortype',
    ];

    // 🔗 العلاقات
    public function hadiths()
    {
        return $this->hasMany(Hadith::class, 'narrator_id');
    }
}
