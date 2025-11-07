<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hadith;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $keyword   = $request->query('keyword');
        $narrator  = $request->query('narrator');  // الراوي
        $scholar   = $request->query('scholar');   // المحدث
        $topic     = $request->query('topic');     // الفئة

        $query = Hadith::query();

        // 🔍 Keyword search
        if ($keyword) {
            $query->where(function ($q) use ($keyword) {
                $q->where('HadithText', 'LIKE', "%$keyword%")
                    ->orWhere('TextWithoutDiacritics', 'LIKE', "%$keyword%");
            });
        }

        // 👤 Filter by narrator
        if ($narrator) {
            $query->where('Narrator', $narrator);
        }

        // 📘 Filter by scholar (Muhaddith)
        if ($scholar) {
            $query->where('Source', $scholar);
        }

        // 🏷️ Filter by topic (category)
        if ($topic) {
            $query->whereHas('topics', function ($q) use ($topic) {
                $q->where('topics.TopicID', $topic);
            });
        }

        // 🧩 Include relationships if needed
        $hadiths = $query->with(['narrator', 'source'])->paginate(10);
//        $hadiths = $query->with(['narrator', 'source', 'topics'])->paginate(10);
        return response()->json([
            'success' => true,
            'count'   => $hadiths->total(),
            'data'    => $hadiths->items(),
        ]);
    }
}
