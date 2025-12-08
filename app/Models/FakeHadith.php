<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeHadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'FakeHadithText',
        'Ruling',
        'SubValid',
    ];





    public function subvalid()
    {
        return $this->belongsTo(Hadith::class, 'SubValid');
    }

    public function ruling()
    {
        return $this->belongsTo(RulingOfHadith::class, 'Ruling');
    }

}
