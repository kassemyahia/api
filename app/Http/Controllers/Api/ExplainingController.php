<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Explaining;
use Illuminate\Http\Request;

class ExplainingController extends Controller
{
    public function index()
    {
        return Explaining::orderBy('id')->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'ETEXT' => 'required|string',
        ]);

        $explaining = Explaining::create($data);

        return response()->json($explaining, 201);
    }

    public function show(Explaining $explaining)
    {
        return $explaining;
    }

    public function update(Request $request, Explaining $explaining)
    {
        $explaining->update($request->all());

        return response()->json($explaining);
    }

    public function destroy(Explaining $explaining)
    {
        $explaining->delete();

        return response()->json(null, 204);
    }
}
