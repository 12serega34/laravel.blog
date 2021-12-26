<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Регистрация</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/admin.css') }}">
</head>
<body class="hold-transition register-page">
<div class="register-box" style="margin-left:auto; margin-right:auto">
    <div class="register-logo">
        <b>Регистрация</b>
    </div>
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card">
        <div class="card-body register-card-body">
            <p class="login-box-msg">Заполните форму регистрации</p>

            <form action="{{ route('register.store') }}" method="post">
                @csrf

                <div class="input-group mb-3">
                    <input type="text" name="name" class="form-control" placeholder="Имя (обязательно)" value="{{ old('name') }}" >
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                </div>
                <div class="input-group mb-3">
                    <input type="email" name="email" class="form-control @error('title') is-invalid @enderror" placeholder="Email (обязательно)" value="{{ old('email') }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password" class="form-control @error('title') is-invalid @enderror" placeholder="Пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" name="password_confirmation" class="form-control @error('title') is-invalid @enderror" placeholder="Повторите пароль">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary btn-block">Регистрация</button>
                    <a class="btn btn-block" href="{{ route('login.form') }}">Авторизация</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

