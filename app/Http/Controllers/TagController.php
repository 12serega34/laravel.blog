<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function show($slug)
    {
        $tag = Tag::where('slug', $slug)->firstOrFail(); //firstOrFail будет получать первый результат запроса; однако, если результат не найден, будет выброшено исключение. Если исключение не перехвачено, то клиенту автоматически отправляется HTTP-ответ 404
        $posts = $tag->posts()->paginate(4); //принимаем только те посты, которые через модель связаны с тегом
        return view('posts.tag', ['tag' => $tag, 'posts' => $posts]);
    }
}
