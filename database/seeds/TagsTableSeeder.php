<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        foreach(range(1, 10) as $index) {
            Tag::create([
                'name' => $faker->word
            ]);
        }
    }
}
