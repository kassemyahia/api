<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RulingOfHadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'RulingText',
    ];

    // 🔗 العلاقات
    public function hadithsAsMuhaddith()
    {
        return $this->hasMany(Hadith::class, 'ruling_of_muhaddith_id');
    }

    public function hadithsAsFinal()
    {
        return $this->hasMany(Hadith::class, 'final_ruling_id');
    }

    public function fakeruling()
    {
        return $this->hasMany(FakeHadith::class, 'Ruling');
    }
}
