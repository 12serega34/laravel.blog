<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique(); //для ЧПУ адресов - поле должно быть уникальным
            $table->text('description');
            $table->text('content');
            $table->integer('category_id')->unsigned();
            $table->integer('views')->unsigned()->default(0); //хранит количество просмотров
            $table->string('thumbnail')->nullable(); //хранит пути к миниатюре поста, nullable() - необязательное
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
