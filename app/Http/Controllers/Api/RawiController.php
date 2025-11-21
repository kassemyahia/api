<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Rawi;
use Illuminate\Http\Request;

class RawiController extends Controller
{
    public function index()
    {
        return Rawi::query()
            ->select('id','name')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'gender' => 'nullable|string',
            'halalrawi' => 'nullable|string',
        ]);

        $rawi = Rawi::create($data);
        return response()->json($rawi, 201);
    }

    public function show(Rawi $rawi )
    {
        return $rawi;
    }

    public function update(Request $request, Rawi $rawi)
    {
        $rawi->update($request->all());
        return response()->json($rawi);
    }

    public function destroy(Rawi $rawi)
    {
        $rawi->delete();
        return response()->json(null, 204);
    }
}
