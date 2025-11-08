<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use Illuminate\Http\Request;

class HadithController extends Controller
{
    public function index()
    {
        return Hadith::with(['book', 'narrator', 'explaining', 'rulingOfMuhaddith', 'finalRuling'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hadithtext' => 'required|string',
            'textwithoutdiacritics' => 'nullable|string',
            'hadithtype' => 'nullable|string',
            'hadithnumber' => 'nullable|integer',
            'narrator' => 'nullable|exists:narrators,id',
            'Source' => 'nullable|exists:books,id',
            'rulingofmuhaddith' => 'nullable|exists:ruling_of_hadiths,id',
            'finalruling' => 'nullable|exists:ruling_of_hadiths,id',
            'explaining' => 'nullable|exists:explainings,id',
            'adminid' => 'nullable|exists:users,id',
            'subvalid' => 'nullable|integer',
        ]);

        $hadith = Hadith::create($data);
        return response()->json($hadith, 201);
    }

    public function show(Hadith $hadith)
    {
        return $hadith->load(['book', 'narrator', 'explaining']);
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
