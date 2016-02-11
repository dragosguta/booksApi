<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\BookTransformer;

use App\Book;

class BooksController extends ApiController
{
    /**
     * @var Transformers\BookTransformer
     */
    protected $bookTransformer;

    function __construct(BookTransformer $bookTransformer) {
        $this->bookTransformer = $bookTransformer;
    }

    public function index() {
        $books = Book::all();

        return $this->setStatusCode(200)->respond([
            'data' => $this->bookTransformer->transformCollection($books->toArray())
        ]);
    }

    public function show($id) {
        $book = Book::find($id);

        if(!$book) {
            return $this->respondNotFound('Book does not exist.');
        }

        return $this->setStatusCode(200)->respond([
            'data' => $this->bookTransformer->transform($book)
        ]);
    }
}
