<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Book;

class BooksController extends Controller
{
    public function index() {
        $books = Book::all();

        return Response::json([
            'data' => $this->transformCollection($books)
        ], 200);
    }

    public function show($id) {
        $book = Book::find($id);

        if(!$book) {
            return Response::json([
                'error' => [
                'message' => 'Book does not exist'
                ]
            ], 404);
        }

        return Response::json([
            'data' => $this->transform($book->toArray())
        ], 200);
    }

    private function transformCollection($books) {
        return array_map([$this, 'transform'], $books->toArray());
    }

    private function transform($book) {
        return [
        'title' => $book['title'],
        'author' => $book['author'],
        'description' => $book['description'],
        'checked out' => (boolean) $book['some_bool']
        ];
    }
}
