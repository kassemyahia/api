<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HadithResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'HadithType' => $this->HadithType,
            'HadithText' => $this->HadithText,
            'HadithNumber' => $this->HadithNumber,

            // علاقات مختصرة:
            'book' => $this->book?->book_name,
            'rawi' => $this->rawi?->name,
            'explaining' => $this->explaining?->ETEXT,
            'ruling_of_muhaddith' => $this->rulingOfMuhaddith?->RulingText,
            'final_ruling' => $this->finalRuling?->RulingText,
        ];
    }

}
