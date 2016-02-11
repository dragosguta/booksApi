<?php namespace App\Transformers;

class BookTransformer extends Transformer{

    public function transform($book) {
        return [
            'title' => $book['title'],
            'author' => $book['author'],
            'description' => $book['description'],
            'checked out' => (boolean) $book['some_bool']
        ];
    }
}
