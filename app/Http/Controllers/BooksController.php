<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Input;

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

        //old way - filters
        //$this->beforeFilter(['auth.basic', ['on' => 'post']]);
        //new way - middleware
        $this->middleware('auth.basic', ['only' => 'store']);
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

    public function store() {
        if(!Input::get('title') or !Input::get('author') or !Input::get('description')) {
            return $this->setStatusCode(422)->respondWithError('Parameters failed validation for book.');
        }

        Book::create(Input::all());

        return $this->respondCreated('Book successfully created.');
    }
}
