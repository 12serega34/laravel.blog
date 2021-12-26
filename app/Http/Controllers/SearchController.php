<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $rules = [
            'search' => 'required',
        ];
        Validator::make($request->all(), $rules)->validate();

        $posts = Post::where('title', 'like', "%{$request->search}%")->orderBy('id', 'desc')->paginate(3);
        return view('posts.search', ['search' => $request->search, 'posts' => $posts]);
    }
}
