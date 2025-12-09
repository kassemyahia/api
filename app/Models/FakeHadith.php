<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeHadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'FakeHadithText',
        'SubValid',
        'Ruling',
    ];

    public function subvalidfake()
    {
        return $this->belongsTo(Hadith::class, 'SubValid');
    }

    public function rulingfake()
    {
        return $this->belongsTo(RulingOfHadith::class, 'Ruling');
    }

}
