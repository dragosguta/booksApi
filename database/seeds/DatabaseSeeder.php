<?php

use Illuminate\Database\Seeder;
use App\Book;
use App\Tag;

class DatabaseSeeder extends Seeder
{
    private $tables = [
        'books',
        'tags',
        'book_tag'
    ];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BooksTableSeeder::class);
        $this->call(TagsTableSeeder::class);
        $this->call(BookTagTableSeeder::class);
    }

    private function cleanDatabase() {
        //Set checks 0 to avoid 1701 cannot truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        foreach($this->tables as $tableName) {
            DB::table($tableName)->truncate();
        }
        //Reinstate checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
