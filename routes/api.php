<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SearchController;
use App\Http\Controllers\Api\HadithController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\MuhaddithController;
use App\Http\Controllers\Api\RawiController;
use App\Http\Controllers\Api\RulingController;
use App\Http\Controllers\Api\TopicController;
use App\Http\Controllers\Api\ExplainingController;
use Illuminate\Support\Facades\DB;
// routes/api.php
use App\Http\Controllers\Api\Auth\RegisterController;

Route::post('/auth/register', RegisterController::class);


Route::apiResource('hadiths', HadithController::class);

Route::apiResource('books', BookController::class);

Route::apiResource('muhaddiths', MuhaddithController::class);

Route::apiResource('rawis', RawiController::class);

Route::apiResource('ruling_of_hadiths', RulingController::class);

Route::apiResource('topics', TopicController::class);

Route::apiResource('explainings', ExplainingController::class);


Route::post('/register', [AuthController::class, 'register']);


Route::post('/login', [AuthController::class, 'login']);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

});

Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return response()->json(['status' => '✅ Connected to database']);
    } catch (\Exception $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

Route::get('/search', [SearchController::class, 'index']);
