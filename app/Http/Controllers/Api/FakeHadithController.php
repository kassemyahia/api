<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FakeHadithResource;
use App\Models\FakeHadith;
use Illuminate\Http\Request;

class FakeHadithController extends Controller
{
    /**
     * قائمة الأحاديث غير الصحيحة
     */
    public function index()
    {
        return FakeHadithResource::collection(
            FakeHadith::query()
                ->with(['rulingfake', 'subvalidfake'])
                ->orderBy('id')
                ->get()
        );
    }

    /**
     * إضافة حديث غير صحيح
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'FakeHadithText' => 'required|string',
            'SubValid'       => 'nullable|exists:hadiths,id',
            'Ruling'         => 'required|exists:ruling_of_hadiths,id',
        ]);

        $fake = FakeHadith::create($data);

        return new FakeHadithResource(
            $fake->load(['rulingfake', 'subvalidfake'])
        );
    }

    /**
     * جلب حديث غير صحيح واحد (للتحرير)
     */
    
    public function show(FakeHadith $fakehadith)
    {
        return new FakeHadithResource(
            $fakehadith->load(['rulingfake', 'subvalidfake'])
        );
    }

    /**
     * تحديث حديث غير صحيح
     */
    public function update(Request $request, FakeHadith $fakehadith)
    {
        $data = $request->validate([
            'FakeHadithText' => 'sometimes|string',
            'SubValid'       => 'sometimes|exists:hadiths,id',
            'Ruling'         => 'sometimes|exists:ruling_of_hadiths,id',
        ]);

        $fakehadith->update($data);

        return new FakeHadithResource(
            $fakehadith->load(['rulingfake', 'subvalid'])
        );
    }

    /**
     * حذف حديث غير صحيح
     */
    public function destroy(FakeHadith $fakehadith)
    {
        $fakehadith->delete();
        return response()->json(null, 204);
    }
}
