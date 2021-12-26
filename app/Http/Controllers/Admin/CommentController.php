<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $comments = Comment::paginate('10');
        return view('admin.comments.index', compact('comments'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $comments = Comment::find($id);
        return view('admin.comments.edit', compact('comments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'content' => 'required'
        ];
        $messages = [ //любая переменная, содержащая описание ошибок на русском
            'content.required' => 'Это поле не должно быть пустым.'
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $comment = Comment::find($id);
        $comment->update($request->all());

        return redirect()->route('comments.index')->with('success', 'Комментарий изменен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Comment::destroy($id);
        return redirect()->route('comments.index')->with('success', 'Комментарий удален');
    }
}
