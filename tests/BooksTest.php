 <?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class BooksTest extends ApiTester {

    /** @test */
    public function it_fetches_books() {
        //arrange
        $this->times(5)->make('App\Book');

        //act
        $this->getJson('api/v1/books');

        //assert
        $this->assertResponseOk();
    }

    /** @test */
    public function it_fetches_a_single_book() {
        $this->make('App\Book');

        $book = $this->getJson('api/v1/books/1')->data;

        $this->assertResponseOk();

        $this->assertObjectHasAttributes($book, 'title', 'author', 'description');
    }

    /** @test */
    public function it_404s_if_a_book_is_not_found() {
        $this->getJson('api/v1/lessons/x');

        $this->assertResponseStatus(404);
    }

    /** @test */
    public function it_creates_a_new_book_given_valid_parameters() {
        //Must authorize
        $this->getJson('api/v1/books', 'POST', $this->getStub());

        $this->assertResponseStatus(201);
    }

    /** @test */
    public function it_throws_a_422_if_a_new_book_request_fails_validation() {
        $this->getJson('api/v1/books', 'POST');

        $this->assertResponseStatus(422);
    }

    protected function getStub() {
        return [
            'title' => $this->fake->sentence,
            'author' => $this->fake->sentence,
            'description' => $this->fake->paragraph,
            'some_bool' => $this->fake->boolean
        ];
    }
}
