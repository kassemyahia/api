<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'hadithtext',
        'textwithoutdiacritics',
        'hadithtype',
        'hadithnumber',
        'Rawi',
        'Source',
        'rulingofmuhaddith',
        'finalruling',
        'explaining',
        'subvalid',
    ];

    // 🔗 العلاقات
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function rawi()
    {
        return $this->belongsTo(Rawi::class, 'Rawi');
    }

    public function explaining()
    {
        return $this->belongsTo(Explaining::class, 'explaining_id');
    }

    public function rulingOfMuhaddith()
    {
        return $this->belongsTo(RulingOfHadith::class, 'ruling_of_muhaddith_id');
    }

    public function finalRuling()
    {
        return $this->belongsTo(RulingOfHadith::class, 'final_ruling_id');
    }

//    public function admin()
//    {
//        return $this->belongsTo(User::class, 'admin_id');
//    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_classes', 'hadith_id', 'topic_id');
    }
}
