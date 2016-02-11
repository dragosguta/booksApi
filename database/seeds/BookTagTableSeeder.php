<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Tag;
use App\Book;

class BookTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $bookIDs = Book::lists('id')->toArray(); //return array with all ids
        $tagIDs = Tag::lists('id')->toArray();

        foreach(range(1, 30) as $index) {
            //insert real book id
            //insert real tag id
            DB::table('book_tag')->insert([
                'book_id' => $faker->randomElement($bookIDs),
                'tag_id' => $faker->randomElement($tagIDs)
            ]);
        }
    }
}
