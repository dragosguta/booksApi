 <?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Book;

class BooksTest extends ApiTester {
    /** @test */
    public function it_fetches_books() {
        //arrange
        $this->times(5)->makeBook();

        //act
        $this->getJson('api/v1/books', null);

        //assert
        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_book() {
        $this->makeBook();

        $book = $this->getJson('api/v1/books/1')->data;

        $this->assertResponseOk();

        $this->assertObjectHasAttributes($book, 'title', 'author', 'description');
    }

    /** @test */
    public function it_404s_if_a_lesson_is_not_found() {
        $this->getJson('api/v1/lessons/x');

        $this->assertResponseStatus(404);
    }

    public function makeBook($bookFields = []) {

        //Use array_merge to override default fields
        $book = array_merge([
            'title' => $this->fake->sentence,
            'author' => $this->fake->sentence,
            'description' => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean
        ], $bookFields);

        while($this->times--)
            Book::create($book);
    }
}
