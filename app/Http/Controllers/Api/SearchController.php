<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hadith; // Example Model
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        if (!$query) {
            return response()->json(['message' => 'Search query is required'], 400);
        }

        // Example: Searching for products by name or description
        $results = hadith::where('HadithText', 'LIKE', "%{$query}%")
            ->orWhere('TextWithoutDiacritics', 'LIKE', "%{$query}%")
            ->get();

        // You might use API Resources here for more structured output
        // return ProductResource::collection($results);

        return response()->json($results);
    }
}
