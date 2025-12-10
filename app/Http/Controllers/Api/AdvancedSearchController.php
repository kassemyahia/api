<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HadithResource;
use App\Models\Hadith;
use Illuminate\Http\Request;

class AdvancedSearchController extends Controller
{
    public function index(Request $request)
    {
        $text = $request->input('text');

        $rawi = (array) $request->input('rawi', []);
        $rul = (array) $request->input('rul', []);
        $book = (array) $request->input('book', []);
        $type = (array) $request->input('type', []);
        $topic = (array) $request->input('topic', []);
        $muhaddith = (array) $request->input('muhaddith', []);

        $hadiths = Hadith::with([
            'book',
            'rawi',
            'explaining',
            'rulingOfMuhaddith',
            'finalRuling',
            'topics',
        ]);

        if ($text) {
            $hadiths->where(function ($q) use ($text) {
                $q->where('HadithText', 'LIKE', "%{$text}%")
                    ->orWhere('TextWithoutDiacritics', 'LIKE', "%{$text}%");
            });
        }

        if (! empty($rawi)) {
            $hadiths->whereIn('Rawi', $rawi);
        }

        if (! empty($rul)) {
            $hadiths->whereIn('FinalRuling', $rul);
        }

        if (! empty($book)) {
            $hadiths->whereIn('Source', $book);
        }

        if (! empty($muhaddith)) {
            $hadiths->whereHas('book', function ($q) use ($muhaddith) {
                $q->whereIn('muhaddith', $muhaddith);
            });
        }

        if (! empty($topic)) {
            $hadiths->whereHas('topics', function ($q) use ($topic) {
                $q->whereIn('topics.id', $topic);
            });
        }

        if (! empty($type)) {
            $hadiths->whereIn('HadithType', $type);
        }

        return HadithResource::collection($hadiths->get());
    }
}
