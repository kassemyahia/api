<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Narrator;
use Illuminate\Http\Request;

class NarratorController extends Controller
{
    public function index()
    {
        return Narrator::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'gender' => 'nullable|string',
            'narratortype' => 'nullable|string',
        ]);

        $narrator = Narrator::create($data);
        return response()->json($narrator, 201);
    }

    public function show(Narrator $narrator)
    {
        return $narrator;
    }

    public function update(Request $request, Narrator $narrator)
    {
        $narrator->update($request->all());
        return response()->json($narrator);
    }

    public function destroy(Narrator $narrator)
    {
        $narrator->delete();
        return response()->json(null, 204);
    }
}
