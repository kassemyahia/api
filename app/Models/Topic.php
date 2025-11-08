<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'TopicName',
    ];

    // 🔗 العلاقات
    public function hadiths()
    {
        return $this->belongsToMany(Hadith::class, 'topic_classes', 'topic_id', 'hadith_id');
    }
}
