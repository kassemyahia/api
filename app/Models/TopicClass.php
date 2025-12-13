<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicClass extends Model
{
    use HasFactory;

    protected $fillable = [
        'TopicID',
        'HadithID',
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class, 'TopicID');
    }

    public function hadith()
    {
        return $this->belongsTo(Hadith::class, 'HadithID');
    }
}
