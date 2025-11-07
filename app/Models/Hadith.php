<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hadith extends Model
{
    public function narrator()
    {
        return $this->belongsTo(Narrator::class, 'Narrator');
    }

    public function source()
    {
        return $this->belongsTo(Book::class, 'Source');
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'topic_classes', 'HadithID', 'TopicID');
    }

}
