<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use Illuminate\Http\Request;
use App\Http\Resources\HadithResource;

class AdvancedSearchController extends Controller
{
    public function index(Request $request)
    {
        $text       = $request->input('text');
        $rawi       = $request->input('rawi');
        $muhaddith  = $request->input('muhaddith');
        $topic      = $request->input('topic');
        $book       = $request->input('book');
        $rul        = $request->input('rul');



        $hadiths = Hadith::with([
            'book',
            'rawi',
            'explaining',
            'rulingOfMuhaddith',
            'finalRuling',
            'topics'
        ]);

        if ($text) {
            $hadiths->where(function ($q) use ($text) {
                $q->where('HadithText', 'LIKE', "%{$text}%")
                    ->orWhere('TextWithoutDiacritics', 'LIKE', "%{$text}%");
            });
        }

        if ($rawi) {
            $hadiths->where('Rawi', $rawi);
        }

        if ($rul) {
            $hadiths->where('FinalRuling', $rul);
        }

        if ($book) {
            $hadiths->where('Source', $book);
        }
        if ($muhaddith) {
            $hadiths->whereHas('book', function ($q) use ($muhaddith) {
                $q->where('muhaddith', $muhaddith);
            });
        }

        if ($topic) {
            $hadiths->whereHas('topics', function ($q) use ($topic) {
                $q->where('topics.id', $topic);
            });
        }

        return HadithResource::collection($hadiths->get());
    }
}
