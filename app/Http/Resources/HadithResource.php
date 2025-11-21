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
            'id' => $this->id,

            'HadithType' => $this->HadithType,
            'HadithText' => $this->HadithText,
            'HadithNumber' => $this->HadithNumber,

            // للعلاقات → نرجع الـ name + id
            'book' => [
                'id'   => $this->book?->id,
                'name' => $this->book?->book_name,
            ],

            'rawi' => [
                'id'   => $this->rawi?->id,
                'name' => $this->rawi?->name,
            ],

            'explaining' => [
                'id'    => $this->explaining?->id,
                'text'  => $this->explaining?->ETEXT,
            ],

            'ruling_of_muhaddith' => [
                'id'   => $this->rulingOfMuhaddith?->id,
                'text' => $this->rulingOfMuhaddith?->RulingText,
            ],

            'final_ruling' => [
                'id'   => $this->finalRuling?->id,
                'text' => $this->finalRuling?->RulingText,
            ],
        ];
    }

}
