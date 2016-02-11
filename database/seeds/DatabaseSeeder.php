<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Set checks 0 to avoid 1701 cannot truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Book::truncate();
        Tag::truncate();
        DB::table('book_tag')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $this->call(BooksTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
    }
}
