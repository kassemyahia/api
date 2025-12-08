<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
class FakeHadithResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'        => $this->id,
            'text'      => $this->FakeHadithText,
            'sub_valid' => [
                'id'   => $this->subvalid?->id,
                'text' => $this->subvalid?->HadithText,
            ],
            'ruling'    =>  [
                'id'   => $this->ruling?->id,
                'text' => $this->ruling?->RulingText,
            ],
            // 'hadith'    => $this->hadith?->HadithText,
        ];
    }
}


