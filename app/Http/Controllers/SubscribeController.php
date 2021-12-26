<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubscribeController extends Controller
{

    public function store(Request $request)
    {
        $rules = [
            'email' => 'required|email|unique:subscriptions',
        ];
        $messages = [
            'email.required' => 'Поле не должно быть пустым',
            'email.email' => 'Введите email в нужном формате',
            'email.unique' => 'Такой Email уже зарегистрирован в системе',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        Subscription::create($request->all());

        $request->session()->flash('subscribe', 'Подписка оформлена!');

        return redirect()->back();
    }
}
