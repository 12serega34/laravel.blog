<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $posts = $category->posts()->paginate(4); //принимаем только те посты, которые через модель Category связаны с данной категорией
        return view('posts.category', ['category' => $category, 'posts' => $posts]);
    }
}
