<?php

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $authors = [
            ['name' => 'George Orwell'],
            ['name' => 'Joseph Murphy'],
            ['name' => 'J. G. Ballard'],
            ['name' => 'Michel Foucault'],
            ['name' => 'Vladimir Nabokov'],
            ['name' => 'Milton Crane'],
        ];

        foreach ($authors as $author) {
            Author::create([
                'name' => $author['name']
            ]);
        }
    }
}
