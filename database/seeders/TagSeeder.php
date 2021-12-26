<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //\App\Models\Tag::factory(10)->create(); //так создастся 20 новых тегов - если прописать в DatabaseSeeder
        \App\Models\Tag::factory(10)->create(); //так создастся 20 новых тегов - если прописать в DatabaseSeeder

    }
}
