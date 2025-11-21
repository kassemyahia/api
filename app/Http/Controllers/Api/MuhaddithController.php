<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Muhaddith;
use Illuminate\Http\Request;

class MuhaddithController extends Controller
{
    public function index()
    {
        return Muhaddith::query()
            ->select('id','name')
            ->get();
    }
    public function listWithAbout()
    {
        return Muhaddith::query()
            ->select('name', 'about')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'gender' => 'nullable|string',

        ]);

        $muhaddith = Muhaddith::create($data);
        return response()->json($muhaddith, 201);
    }

    public function show(Muhaddith $muhaddith )
    {
        return $muhaddith;
    }

    public function update(Request $request, Muhaddith $muhaddith)
    {
        $muhaddith->update($request->all());
        return response()->json($muhaddith);
    }

    public function destroy(Muhaddith $muhaddith)
    {
        $muhaddith->delete();
        return response()->json(null, 204);
    }
}
