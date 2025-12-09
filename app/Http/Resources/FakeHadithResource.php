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
                'id'   => $this->subvalidfake?->id,
                'text' => $this->subvalidfake?->HadithText,
            ],
            'ruling'    =>  [
                'id'   => $this->rulingfake?->id,
                'text' => $this->rulingfake?->RulingText,
            ],
            // 'hadith'    => $this->hadith?->HadithText,
        ];
    }
}


