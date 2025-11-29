<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FakeHadith;
use Illuminate\Http\Request;
use App\Http\Resources\FakeHadithResource;

class FakeSearchController extends Controller
{
public function index(Request $request)
{
$text = $request->input('text');

if (!$text) {
return response()->json([
'error' => 'text parameter is required'
], 400);
}

$results = FakeHadith::where('FakeHadithText', 'LIKE', "%{$text}%")
->with([ 'ruling'])
->orderBy('id', 'DESC')
->get();

return FakeHadithResource::collection($results);
}
}
