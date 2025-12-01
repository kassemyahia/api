<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\HadithResource;


class FavoriteController extends Controller
{

    public function userFavorites(Request $request)
    {
        $user = $request->user(); // المستخدم الحالي من الـ token

        return HadithResource::collection(
            $user->favorites()->with([
                'book',
                'rawi',
                'explaining',
                'rulingOfMuhaddith',
                'finalRuling',
                'topics'
            ])->get()
        );
    }
    public function add(Request $request)
    {
        $request->validate([
            'hadith_id' => 'required|integer|exists:hadiths,id',
        ]);

        $user = $request->user();

        // التأكد إن الحديث ليس مضاف مسبقاً
        if ($user->favorites()->where('hadith_id', $request->hadith_id)->exists()) {
            return response()->json([
                'added' => false,
                'message' => 'الحديث موجود مسبقاً في المفضلة'
            ], 200);
        }

        // إضافة الحديث
        $user->favorites()->attach($request->hadith_id);

        return response()->json([
            'added' => true,
            'message' => 'تم إضافة الحديث إلى المفضلة'
        ], 201);
    }

    /**
     * إزالة حديث من المفضلة
     */
    public function remove(Request $request)
    {
        $request->validate([
            'hadith_id' => 'required|integer|exists:hadiths,id',
        ]);

        $user = $request->user();

        // حذف الحديث من المفضلة
        $deleted = $user->favorites()->detach($request->hadith_id);

        return response()->json([
            'removed' => $deleted > 0,
            'message' => $deleted ? 'تمت الإزالة بنجاح' : 'الحديث غير موجود في المفضلة'
        ], 200);
    }
}
