@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->

    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script>

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Редактирование</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Изменение статьи "{{ $posts->title }}"</h3>
                        </div>
                        <!-- /.card-header -->
                        <form role="form" method="post" action="{{ route('posts.update', ['post' => $posts->id]) }}" enctype="multipart/form-data"> {{--['post' => $posts->id] - значение $posts->id будет доступно в контроллере в store в $id--}}
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Заголовок</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ $posts->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Короткое описание</label>
                                    <textarea name="description" class="form-control" rows="3" id="description">{{ $posts->description }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="content">Текст статьи</label>
                                    <textarea name="content" class="form-control" rows="10" id="content" >{{ $posts->content }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="category_id">Выберите категорию</label>
                                    <select name="category_id" class="form-control" id="category_id">
                                        @foreach($categories as $k => $v)
                                            <option value="{{ $k }}" @if($posts->category_id == $k) selected @endif>{{ $v }}</option>
                                        @endforeach {{--делаем, чтобы передавалaсь выбранная категория--}}
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Выберите теги</label>
                                    <select multiple="" name="tags[]" class="custom-select" id="tags">  {{--name="tags[]" - т.к. выбирать можем несколько тегов. Если без знака массива, придет только один тег--}}
                                        @foreach($tags as $k => $v)
                                            <option value="{{ $k }}" @if(in_array($k, $posts->tags->pluck('id')->all())) selected @endif>{{ $v }}</option> {{--делаем, чтобы передавались выбранные теги--}}
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="thumbnail">Изображение</label>
                                    <div class="custom-file">
                                        <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
                                        <label class="custom-file-label" for="thumbnail">Выберите изображение</label>
                                    </div>
                                        <img src="{{ $posts->getImage() }}" alt="" width="150" class="img-thumbnail mt-2">

                                    @if($posts->thumbnail){{-- Если в прошлой редакции статьи есть изображение, выводим кнопку--}}
                                        /*кнопку которая бы удаляла изображение не смог доделать*/
                                    @endif

                                    @if (session()->has('deleteImage'))
                                        <div class="alert alert-success">
                                            {{ session('deleteImage') }}
                                        </div>
                                    @endif

                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

