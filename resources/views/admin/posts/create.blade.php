@extends('admin.layouts.layout')

@section('content')
    <script src="{{ asset('assets/admin/ckeditor/ckeditor.js') }}"></script> {{--скрипт для добавления блока редактирования в поле textarea. Еще часть скрипта в layout.blade --}}

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Добавление статьи</h1>
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
                            <!-- /.card-header -->
                            <form role="form" method="post" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="title">Название</label>
                                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" placeholder="Название">
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Короткое описание</label>
                                        <textarea name="description" class="form-control @error('title') is-invalid @enderror" rows="3" id="description" placeholder="Добавьте короткое описание..."></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Текст статьи</label>
                                        <textarea name="content" class="form-control @error('title') is-invalid @enderror" rows="10" id="content" placeholder="Введите текст статьи"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label for="category_id">Выберите категорию</label>
                                        <select name="category_id" class="form-control" id="category_id">
                                            @foreach($categories as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="tags">Выберите теги</label>
                                        <select multiple="" name="tags[]" class="custom-select" id="tags">  {{--name="tags[]" - т.к. выбирать можем несколько тегов. Если без знака массива, придет только один тег--}}
                                            @foreach($tags as $k => $v)
                                                <option value="{{ $k }}">{{ $v }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="thumbnail">Изображение</label>
                                        <div class="custom-file">
                                            <input type="file" name="thumbnail" class="custom-file-input" id="thumbnail">
                                            <label class="custom-file-label" for="thumbnail">Выберите изображение</label>
                                        </div>
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

