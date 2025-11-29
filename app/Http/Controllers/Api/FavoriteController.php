<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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

}
