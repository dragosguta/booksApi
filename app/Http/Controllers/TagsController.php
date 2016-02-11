<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Transformers\TagTransformer;

use App\Tag;
use App\Book;

class TagsController extends ApiController
{
    protected $tagTransformer;

    public function __construct(TagTransformer $tagTransformer) {
        $this->tagTransformer = $tagTransformer;
    }

    public function index($bookID = null) {

        $tags = $this->getTags($bookID);

        return $this->respond([
            'data' => $this->tagTransformer->transformCollection($tags->all())
        ]);
    }

    private function getTags($bookID) {
        return $bookID ? Book::findOrFail($bookID)->tags : Tag::all();
    }
}
