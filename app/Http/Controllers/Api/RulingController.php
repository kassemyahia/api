<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\RulingOfHadith;
use Illuminate\Http\Request;

class RulingController extends Controller
{
    public function index()
    {
        return RulingOfHadith::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'RulingText' => 'required|string',
        ]);

        $ruling = RulingOfHadith::create($data);
        return response()->json($ruling, 201);
    }

    public function show(RulingOfHadith $ruling_of_hadith)
    {
        return $ruling_of_hadith;
    }

    public function update(Request $request, RulingOfHadith $ruling_of_hadith)
    {
        $ruling_of_hadith->update($request->all());
        return response()->json($ruling_of_hadith);
    }

    public function destroy(RulingOfHadith $ruling_of_hadith)
    {
        $ruling_of_hadith->delete();
        return response()->json(null, 204);
    }
}
