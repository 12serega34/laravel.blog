<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;

class MainController extends Controller
{
    public function index()
    {
        /*$tag = new Tag(); //использовали для проверки работоспособности библиотеки Laravel Slugable. Создали и сохранили новый тайтл - он конвертировался в поле slug в нужный формат
        $tag->title = 'Новый Пример';
        $tag->save();*/
        $categoriesCount = Category::count(); //передали количество записей в категориях
        $tagsCount =Tag::count();
        $postsCount = Post::count();
        $commentsCount = Comment::count();
        return view('admin.index', compact('categoriesCount', 'tagsCount', 'postsCount', 'commentsCount'));
    }

}
