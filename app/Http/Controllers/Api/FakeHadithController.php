<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FakeHadith;
use Illuminate\Http\Request;
use function Laravel\Prompts\select;

class FakeHadithController extends Controller
{
    public function index(){
        return FakeHadith::query()
            ->select('id','FakeHadithText','Ruling')
            ->get();
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'FakeHadithText' => 'required|string',
            'SubValid'       => 'required|integer|exists:hadiths,id',
            'Ruling'         => 'required|integer|exists:ruling_of_hadiths,id',
        ]);

        $fake = FakeHadith::create($data);

        return response()->json($fake, 201);
    }
    public function show(FakeHadith $fakeHadith)
    {
        return $fakeHadith->load([
            'correctHadith:id,HadithText',
            'ruling:id,RulingText'
        ]);
    }
    public function update(Request $request, FakeHadith $fakeHadith)
    {
        $data = $request->validate([
            'FakeHadithText' => 'sometimes|string',
            'SubValid'       => 'nullable|integer|exists:hadiths,id',
            'Ruling'         => 'sometimes|integer|exists:ruling_of_hadiths,id',
        ]);

        $fakeHadith->update($data);

        return response()->json($fakeHadith);
    }

    public function destroy(FakeHadith $fakeHadith)
    {
        $fakeHadith->delete();
        return response()->json(null, 204);
    }


}
