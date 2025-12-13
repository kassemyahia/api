<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TopicClass;
use Illuminate\Http\Request;

class TopicClassController extends Controller
{
    public function index()
    {
        return TopicClass::query()
            ->select('id', 'TopicID', 'HadithID')
            ->orderBy('id')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $topicClass = TopicClass::create($data);

        return response()->json($topicClass, 201);
    }

    public function show(TopicClass $topicClass)
    {
        return $topicClass->load(['topic:id', 'hadith:id']);
    }

    public function update(Request $request, TopicClass $topicClass)
    {
        $data = $this->validateData($request, $topicClass->id);
        $topicClass->update($data);

        return response()->json($topicClass);
    }

    public function destroy(TopicClass $topicClass)
    {
        $topicClass->delete();

        return response()->json(null, 204);
    }

    private function validateData(Request $request)
    {
        return $request->validate([
            'TopicID' => 'required|exists:topics,id',
            'HadithID' => 'required|exists:hadiths,id',
        ]);
    }
}
