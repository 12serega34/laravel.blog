<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */

    public function index()
    {
        $posts = Post::with('category', 'tags')->paginate(20); //используем жадную загрузку для оптимизации запросов к БД с помощью with().
        $categories = Category::pluck('title', 'id')->all();
        return view('admin.posts.index', compact('posts', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|\Illuminate\Http\Response
     */

    public function create()
    {
        $categories = Category::pluck('title', 'id')->all(); //передаем в представление методом pluck нужные поля
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.create' , compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request) //сохранение статьи
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image',
        ];
        $messages = [ //любая переменная, содержащая описание ошибок на русском
            'title.required' => 'Это поле не должно быть пустым.',
            'description.required' => 'Это поле не должно быть пустым.',
            'content.required' => 'Это поле не должно быть пустым.',
            'thumbnail.image' => 'Загрузите изображение в формате jpg, jpeg, png, bmp, gif, svg или webp',

        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $data = $request->all();

        //закомментировал, т.к. создал метод в Post для этих действий
        /*if($request->hasFile('thumbnail')) //Вы можете определить, есть ли в запросе файл, с помощью метода hasFile
        {
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}"); //По умолчанию метод store загружаемого файла будет использовать ваш диск по умолчанию. Диск устанавливается в config/filesystems.php и в .env. file() - выдает файл, видимый через request
        }*/

        $data['thumbnail'] = Post::uploadImage($request);

        $post = Post::create($data); //создаем $post вместо того, чтобы просто сохранить через модель данные, чтобы потом добавить теги - поработать с этой переменной

        $post->tags()->sync($request->tags); //сохраняем в промежуточной таблице данные, которые пришли из $request->tags с помощью метода sync - он сохраняет и синхронизирует данные. Старые удаляет, новые(которые пришли из request) добавляет. Сохраняем все в $post->tags()
        return redirect()->route('posts.index')->with('success', 'Статья добавлена'); //не забывать заполнить поле $fillable в модели - чтобы разрешить массовое заполнение, with('success', 'Категория добавлена') - передаем сообщение об успехе
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View|\Illuminate\Http\Response
     */
    public function edit($id) //здесь мы изменяем и сохраняем данные, попадая в метод update(обновить)
    {
        $categories = Category::pluck('title', 'id')->all();
        $posts = Post::find($id); //метод find() получает одну строку по значению столбца id
        $tags = Tag::pluck('title', 'id')->all();
        return view('admin.posts.edit', compact('categories', 'posts', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */


    public function update(Request $request, $id) //попали сюда с измененными данными из edit(). Провалидировали. Сохранили данные. Перенаправили
    {
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'content' => 'required',
            'thumbnail' => 'nullable|image',
        ];
        $messages = [ //любая переменная, содержащая описание ошибок на русском
            'title.required' => 'Это поле не должно быть пустым.',
            'description.required' => 'Это поле не должно быть пустым.',
            'content.required' => 'Это поле не должно быть пустым.',
            'thumbnail.image' => 'Загрузите изображение в формате jpg, jpeg, png, bmp, gif, svg или webp',

        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $post = Post::find($id); //метод find() получает одну строку по значению столбца id. Содержит все данные из старой(не отредактированной) записи. Например, $post->thumbnail содержит ссылку на старое изображение
        $data = $request->all(); //$data содержит все данные из отредактированного поста

        /*if($request->hasFile('thumbnail')) //Вы можете определить, есть ли в запросе файл, с помощью метода hasFile
        {
            Storage::delete($post->thumbnail); //если картинка была загружена раньше(до внесения изменений в пост), мы ее удаляем и добавляем новую - которая пришла из $request
            $folder = date('Y-m-d');
            $data['thumbnail'] = $request->file('thumbnail')->store("images/{$folder}"); //По умолчанию метод store загружаемого файла будет использовать ваш диск по умолчанию. Диск устанавливается в config/filesystems.php и в .env. file() - выдает файл, видимый через request
        }*/
        if($post->thumbnail){
            if($request->hasFile('thumbnail'))
            {
                $data['thumbnail'] = Post::uploadImage($request, $post->thumbnail);
            }
            else{
                $data['thumbnail'] = $post->thumbnail;
            }
        }else{
            $data['thumbnail'] = Post::uploadImage($request, $post->thumbnail);
        }


        $post->update($data);
        $post->tags()->sync($request->tags);
        return redirect()->route('posts.index')->with('success', 'Статья изменена'); //не забывать заполнить поле $fillable в модели - чтобы разрешить массовое заполнение , with('success', 'Категория добавлена') - передаем сообщение об успехе
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) //есть один момент - можно не удалять реально, а удалять виртуально с помощью Soft Deleting. То есть запись исчезает, но помещается в особое поле для хранения, а не удаляется. Типа как в вордпресс помещается в корзину. Можно использовать для создания корзины
    {
        $post = Post::find($id); //получаем id удаляемого поста
        Storage::delete($post->thumbnail);
        $post->tags()->sync([]);
        $post->delete(); //удаляем*/
        Post::destroy($id); //еще один вариант реализации
        return redirect()->route('posts.index')->with('success', 'Статья удалена');
    }
    public function deleteImage($id)
    {
        $post = Post::find($id);
        $post->thumbnail->delete();
        return redirect()->route('posts.edit')->with('deleteImage', 'Изображение удалено');
    }
}
