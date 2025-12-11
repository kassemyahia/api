<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name',
        'muhaddith',
    ];

    // protected $appends = ['name'];

    // public function getNameAttribute()
    // {
    //     return $this->book_name;
    // }

    // 🔗 العلاقات
    public function hadiths()
    {
        return $this->hasMany(Hadith::class, 'Source');
    }

    public function muhaddith()
    {
        return $this->belongsTo(Muhaddith::class, 'muhaddith');
    }
}
