<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index()
    {
        return Topic::query()
            ->select('id','TopicName')
            ->orderBy('id')
            ->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'TopicName' => 'required|string',
        ]);

        $topic = Topic::create($data);
        return response()->json($topic, 201);
    }

    public function show(Topic $topic)
    {
        return $topic;
    }

    public function update(Request $request, Topic $topic)
    {
        $topic->update($request->all());
        return response()->json($topic);
    }

    public function destroy(Topic $topic)
    {
        $topic->delete();
        return response()->json(null, 204);
    }
}
