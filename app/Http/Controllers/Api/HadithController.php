<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HadithResource;
use App\Models\Hadith;
use Illuminate\Http\Request;

class HadithController extends Controller
{
    public function index()
    {
        return Hadith::with(['book', 'rawi', 'explaining', 'rulingOfMuhaddith', 'finalRuling'])
            ->orderBy('id')
            ->get();
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
        return $hadith->load(['book', 'rawi', 'explaining', 'rulingOfMuhaddith', 'finalRuling', 'topics']);
    }

    public function show_hadith(Request $request)
    {
        $id = $request->input('id');
        $hadith = Hadith::with([
            'book',
            'rawi',
            'explaining',
            'rulingOfMuhaddith',
            'finalRuling',
            'topics',
        ])->find($id);

        if (! $hadith or $id = null) {
            return response()->json(['message' => ' '], 404);
        }

        return new HadithResource($hadith);

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

    public function subvalid(Request $request)
    {
        $id = $request->input('id');
        $hadith = Hadith::with([
            'book',
            'rawi',
            'explaining',
            'rulingOfMuhaddith',
            'finalRuling',
            'topics',
        ])->find($id);

        if (! $hadith or $id = null) {
            return response()->json(['message' => 'لا يوجد صحيح بديل لهذا الحديث'], 404);
        }

        return new HadithResource($hadith);

    }
}
