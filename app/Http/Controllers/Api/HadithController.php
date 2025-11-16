<?php

namespace App\Http\Controllers\Api;

use App\Helpers\TextHelper;
use App\Http\Controllers\Controller;
use App\Models\Hadith;
use Illuminate\Http\Request;

class HadithController extends Controller
{
    public function index()
    {
        return Hadith::with(['book', 'rawi', 'explaining', 'rulingOfMuhaddith', 'finalRuling'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'HadithText' => 'required|string',
            'HadithType' => 'nullable|string',
            'HadithNumber' => 'nullable|integer',
            'Rawi' => 'nullable|exists:rawis,id',
            'Source' => 'nullable|exists:books,id',
            'RulingOfMuhaddith' => 'nullable|exists:ruling_of_hadiths,id',
            'FinalRuling' => 'nullable|exists:ruling_of_hadiths,id',
            'Explaining' => 'nullable|exists:explainings,id',
            'SubValid' => 'nullable|integer',
        ]);

        $hadith = Hadith::create($data);
        return response()->json($hadith, 201);
    }

    public function show(Hadith $hadith)
    {
        return $hadith->load(['book', 'rawi', 'explaining']);
    }

    public function update(Request $request, Hadith $hadith)
    {
        $hadith->update($request->all());
        return response()->json($hadith);
    }

    public function destroy(Hadith $hadith)
    {
        $hadith->delete();
        return response()->json(null, 204);
    }
}
