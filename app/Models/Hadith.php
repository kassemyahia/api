<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
    use HasFactory;

    protected $fillable = [
        'HadithText',
        'TextWithoutDiacritics',
        'HadithType',
        'HadithNumber',
        'Rawi',
        'Source',
        'RulingOfMuhaddith',
        'FinalRuling',
        'Explaining',
        'SubValid',
    ];

    protected $hidden =[
        'id',
        'Rawi',
        'Source',
        'TextWithoutDiacritics',
        'RulingOfMuhaddith',
        'FinalRuling',
        'Explaining',
        'SubValid',
        'created_at',
        'updated_at',
    ];

    // 🔗 العلاقات
    public function book()
    {
        return $this->belongsTo(Book::class, 'Source');
    }

    public function rawi()
    {
        return $this->belongsTo(Rawi::class, 'Rawi');
    }

    public function explaining()
    {
        return $this->belongsTo(Explaining::class, 'Explaining');
    }

    public function rulingOfMuhaddith()
    {
        return $this->belongsTo(RulingOfHadith::class, 'RulingOfMuhaddith');
    }

    public function finalRuling()
    {
        return $this->belongsTo(RulingOfHadith::class, 'FinalRuling');
    }

//    public function admin()
//    {
//        return $this->belongsTo(User::class, 'admin_id');
//    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_classes', 'hadithID', 'topicID');
    }
}
