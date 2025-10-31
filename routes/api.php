<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

//Route::post('/login', function (Request $request) {
//    return response()->json([
//        'message' => 'تم تسجيل الدخول بنجاح ✅',
//        'email' => $request->email,
//        'password' => $request->password
//    ]);
//});



Route::get('/test', function () {
    return response()->json([
        'message' => 'API working successfully 🎉',
        'status' => 'ok'
    ]);
});
