<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function index()
    {

        $categories = Category::paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */

    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required',
        ];
        $messages = [ //любая переменная, содержащая описание ошибок на русском
            'title.required' => 'Это поле не должно быть пустым.',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();
        Category::create($request->all());
        return redirect()->route('categories.index')->with('success', 'Категория добавлена'); //не забывать заполнить поле $fillable в модели - чтобы разрешить массовое заполнение , with('success', 'Категория добавлена') - передаем сообщение об успехе
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id) //здесь мы изменяем категорию и сохраняем данные, попадая в метод update(обновить)
    {
        $categories = Category::find($id); //метод find() получает одну строку по значению столбца id
        return view('admin.categories.edit', compact('categories'));
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
        ];
        $messages = [ //любая переменная, содержащая описание ошибок на русском
            'title.required' => 'Это поле не должно быть пустым',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $category = Category::find($id); //метод find() получает одну строку по значению столбца id
        $category->slug = null; //поле slug будет обновляться вместе с названием категории - пересоздаваться
        $category->update($request->all());
        return redirect()->route('categories.index')->with('success', 'Категория изменена'); //не забывать заполнить поле $fillable в модели - чтобы разрешить массовое заполнение , with('success', 'Категория добавлена') - передаем сообщение об успехе
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id) //есть один момент - можно не удалять реально, а удалять виртуально с помощью Soft Deleting. То есть запись исчезает, но помещается в особое поле для хранения, а не удаляется. Типа как в вордпресс помещается в корзину. Можно использовать для создания корзины
    {
        /*$category = Category::find($id); //получаем id удаляемой категории

        $category->delete(); //удаляем*/

        $category = Category::find($id);
        $relatedPosts = $category->posts()->count();
        if($relatedPosts){
            return redirect()->route('categories.index')->with('alert', 'Категория привязана к статье');
        }else{
            Category::destroy($id); //еще один вариант реализации
            return redirect()->route('categories.index')->with('success', 'Категория удалена');
        }
    }
}
