<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Api\HadithController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\NarratorController;
use App\Http\Controllers\Api\RulingController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ExplainingController;

Route::apiResource('hadiths', HadithController::class);
Route::apiResource('books', BookController::class);
Route::apiResource('narrators', NarratorController::class);
Route::apiResource('ruling_of_hadiths', RulingController::class);
Route::apiResource('topics', TopicController::class);
Route::apiResource('explainings', ExplainingController::class);



Route::get('/search', [SearchController::class, 'search']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [AuthController::class, 'logout']);
});
