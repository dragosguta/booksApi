<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Book;
class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 30) as $index) {
            Book::create([
                'title' => $faker->sentence(1),
                'author'=> $faker->sentence(1),
                'description'=> $faker->sentence(5)
            ]);
        }
    }
}
