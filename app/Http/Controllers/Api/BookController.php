<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::query()
            ->select('book_name')
            ->get();
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'book_name' => 'required|string',
            'muhaddith' => 'nullable|string',
            'num_of_hadiths' => 'nullable|integer',
        ]);

        $book = Book::create($data);
        return response()->json($book, 201);
    }

    public function show(Book $book)
    {
        return $book;
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->all());
        return response()->json($book);
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(null, 204);
    }
}
