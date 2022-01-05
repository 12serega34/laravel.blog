<?php

namespace App\Http\Controllers;


use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(4);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail(); //firstOrFail будет получать первый результат запроса; однако, если результат не найден, будет выброшено исключение. Иначе - если при вводе адреса нужный файл в БД не найден (страницы не существует), клиенту будет отправлен HTTP-ответ 404
        $post->views ++;
        $post->update(); //обновляем, чтобы в базе увеличился счетчик просмотров

        $randomPost = Post::all()->random(2); //отправляем 2 случайные записи в представление - для блока случайных записей

        $comments = Comment::where('post_id', $post->id)->get();;
        $id = [];
        foreach($comments as $comment) {
            $id[] = $comment->value('user_id');
        }

        $userNameForComments = DB::table('users')->where('id', $id)->value('name'); //Если не нужна вся строка, можете извлечь одно значение из записи с помощью метода value, который вернет значение столбца напрямую

        return view('posts.article', compact('post', 'randomPost', 'comments', 'userNameForComments'));
    }

    public function blog()
    {
        $posts = Post::with('category')->orderBy('id', 'desc')->paginate(4);
        return view('posts.blog', compact('posts'));
    }

    public function contact()
    {
        return view('posts.contact_page');
    }

}
