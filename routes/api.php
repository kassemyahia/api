<?php

use App\Http\Controllers\Api\AdminAuthController;
use App\Http\Controllers\Api\AdvancedSearchController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\ExplainingController;
use App\Http\Controllers\Api\FakeHadithController;
use App\Http\Controllers\Api\FakeSearchController;
use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\HadithController;
use App\Http\Controllers\Api\MuhaddithController;
use App\Http\Controllers\Api\RawiController;
use App\Http\Controllers\Api\RulingController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\SimilarHadithController;
use App\Http\Controllers\Api\TopicClassController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// routes/api.php
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', RegisterController::class);

Route::apiResource('hadiths', HadithController::class);

Route::apiResource('books', BookController::class);

Route::apiResource('muhaddiths', MuhaddithController::class);

Route::apiResource('rawis', RawiController::class);

Route::apiResource('ruling_of_hadiths', RulingController::class);

Route::apiResource('topics', TopicController::class);
Route::apiResource('topic_classes', TopicClassController::class);

Route::apiResource('explainings', ExplainingController::class);

Route::apiResource('users', UserController::class);
Route::middleware('auth:sanctum')->get('/me', [UserController::class, 'show']);

Route::apiResource('/fakehadiths', FakeHadithController::class);

Route::post('/register', [AuthController::class, 'register']);

Route::post('/login', [AuthController::class, 'login']);

Route::get('/muhaddiths_with_about', [MuhaddithController::class, 'listWithAbout']);

//  Route::get('/fakehadiths', [FakeHadithController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});

Route::middleware('auth:sanctum')->delete('/delete_account', [AuthController::class, 'deleteAccount']);

Route::get('/similar/{id}', [SimilarHadithController::class, 'index']);

Route::get('/fake_search', [FakeSearchController::class, 'index']);

Route::get('/search', [SearchController::class, 'index']);

Route::get('/advanced_search', [AdvancedSearchController::class, 'index']);

Route::get('subvalid', [HadithController::class, 'subvalid']);

Route::get('show_hadith', [HadithController::class, 'show_hadith']);

Route::middleware('auth:sanctum')->group(function () {

    Route::post('/favorites/add', [FavoriteController::class, 'add']);
    Route::post('/favorites/remove', [FavoriteController::class, 'remove']);

    Route::get('/favorites', [FavoriteController::class, 'userFavorites']);
});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();

        return response()->json(['status' => '✅ Connected to database']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});
// Dashboard-only login
Route::post('/admin/login', [AdminAuthController::class, 'login']);
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->middleware('auth:sanctum');
