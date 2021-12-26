<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{


    public function create()
    {
        return view('user.create');
    }
    public function store(Request $request)
    {

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ];
        $messages = [
            'name.required' => 'Поле "Имя" не должно быть пустым',
            'email.required' => 'Поле "Email" не должно быть пустым',
            'email.email' => 'Введите email',
            'email.unique' => 'Такой Email уже зарегистрирован в системе',
            'password.required' => 'Поле "Пароль" не должно быть пустым',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user); //используем фасад Auth, чтобы сразу авторизовать пользователя на этой странице
        session()->flash('success', 'Регистрация прошла успешно');
        /*@if (session()->has('success')) - выводит сообщение об успехе в представлении
            {{ session('success') }}
        @endif*/
        return redirect()->home();
    }

    public function loginForm()
    {
        return view('user.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $messages = [
            'email.required' => 'Поле "Email" не должно быть пустым',
            'email.email' => 'Введите email',
            'password.required' => 'Поле "Пароль" не должно быть пустым',
        ];
        Validator::make($request->all(), $rules, $messages)->validate();

        if(Auth::attempt([
            'email' => $request['email'],
            'password' => $request['password']]))
        {
            $request->session()->regenerate();
            if(Auth::user()->is_admin){  //Auth::user()->is_admin - получаем доступ к экземпляру авторизованного пользователя. Ищем поле is_admin и сравниваем значение (в базе либо true, либо false). Если true, перенаправляем на админку. Если нет, перенаправляем на home
                return redirect('admin');
            }
            return redirect()->back()->with('loginTrue', 'Вы авторизованы');
        }else{
            return redirect()->back()->with('error', 'Вы допустили ошибку при вводе'); //с помощью with задаем в session под ключом 'error' эту запись. Ее можно вывести в нужном блоке кода через if - @if(session('error')) ...
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->home();
    }
}
