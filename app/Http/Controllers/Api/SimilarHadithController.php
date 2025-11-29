<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use App\Http\Resources\HadithResource;

class SimilarHadithController extends Controller
{
    public function index($id)
    {
        // جلب الحديث الرئيسي
        $hadith = Hadith::find($id);

        if (!$hadith) {
            return response()->json(['error' => 'Hadith not found'], 404);
        }

        // جلب الأحاديث المشابهة من العلاقة
        $similars = $hadith->similarHadiths()
            ->with([
                'book',
                'rawi',
                'explaining',
                'rulingOfMuhaddith',
                'finalRuling',
                'topics'
            ])
            ->get();

        // إرجاعها بنفس تنسيق HadithResource
        return HadithResource::collection($similars);
    }
}
