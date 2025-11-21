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
        return $this->belongsToMany(
            Hadith::class,
            'topic_classes',  // اسم Pivot Table
            'TopicID',        // FK داخل جدول الكسر يشير للموضوع
            'HadithID'        // FK داخل جدول الكسر يشير للحديث
        );
    }

}
