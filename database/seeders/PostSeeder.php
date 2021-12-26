<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;
use App\Models\Post;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function randomTag() //не получается
    {
        //$randomTag = Tag::all()->random(1)->id;
        //$randomTag = Tag::inRandomOrder()->first();
        $randomTag = DB::table('tags')->find(3);
        return $randomTag;
    }

    public function run()
    {
        //\App\Models\Post::factory(50)->create(); //создаем 50 записей. Но проблема - есть связанные теги, связь с которыми прописана в другой таблице. Поэтому нужно создать другую реализацию метода

        /*Post::factory(5) //создаем через фабрику 10 новых постов(Post::factory(2)). У которых будет по 2 тега (->count(2)). Итого создается 10 новых тега - которые будут связаны через промежуточную таблицу с этими постами.
            ->has(Tag::factory()->count(2))
            ->create();*/

        /*Post::factory(5) //Аналогично предыдущей записи
            ->hasTags(2)
            ->create();*/

        Post::factory()->count(50)->create()
            ->each(function ($newPost) {  //Метод each перебирает элементы в коллекции и передает каждый элемент в функцию обратного вызова
                $post_tag = Tag::find(rand(391, 394)); // find() - это команда запроса в БД. Если ей передать единственный параметр, Ларавел предположит, что это первичный ключ и выдаст запись с таким ключом. - так работает
                //$post_tag = Tag::all('id')->random(); //так тоже работает, но нельзя обозначать аргументы для random
                $newPost->tags()->save($post_tag);
            })->each(function ($newPost) {  //вызываем несколько раз, чтобы создать несколько связей вновь созданных постов со старыми тегами
                $post_tag = Tag::find(rand(395, 397));
                $newPost->tags()->save($post_tag);
            })->each(function ($newPost) {  //вызываем несколько раз, чтобы создать несколько связей вновь созданных постов со старыми тегами
                $post_tag = Tag::find(rand(398, 400));
                $newPost->tags()->save($post_tag);
            });
    }
}
