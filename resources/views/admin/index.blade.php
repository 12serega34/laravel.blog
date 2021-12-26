@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Главная</h1>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card">


                <div class="card-header">
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                title="Collapse">
                            <i class="fas fa-minus"></i></button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                                title="Remove">
                            <i class="fas fa-times"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-nowrap">
                            <thead>
                            <tr>
                                <th>Всего категорий: {{ $categoriesCount }}</th>
                                <th>Всего статей: {{ $postsCount }}</th>
                                <th>Всего тегов: {{ $tagsCount }}</th>
                                <th>Всего комментариев: {{ $commentsCount }}</th>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <div class="card-title">
                                        <td>
                                            <a href="{{ route('categories.index') }}" class="btn btn-primary mr-2">Подробней</a>
                                            <a href="{{ route('categories.create') }}" class="btn btn-primary">Добавить категорию</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('posts.index') }}" class="btn btn-primary mr-2">Подробней</a>
                                            <a href="{{ route('posts.create') }}" class="btn btn-primary">Добавить статью</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('tags.index') }}" class="btn btn-primary mr-2">Подробней</a>
                                            <a href="{{ route('tags.create') }}" class="btn btn-primary">Добавить теги</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('comments.index') }}" class="btn btn-primary mr-2">Подробней</a>
                                            <a href="{{ route('comments.create') }}" class="btn btn-primary">Редактировать комментарии</a>
                                        </td>
                                    </div>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    Footer
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
@endsection
