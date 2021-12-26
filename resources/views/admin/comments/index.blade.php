@extends('admin.layouts.layout')

@section('content')
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Комментарии</h1>
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
                                <h3 class="card-title">Список комментариев</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                @if (count($comments))
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover text-nowrap">
                                            <thead>
                                            <tr>
                                                <th style="width: 30px">#</th>
                                                <th>Текст комментария</th>
                                                <th>Статья</th>
                                                <th>Пользователь</th>
                                                <th>Дата создания</th>
                                                <th>Дата обновления</th>
                                                <th>Действия</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($comments as $comment)
                                                <tr>
                                                    <td>{{ $comment->id }}</td>
                                                    <td>{{ $comment->content }}</td>
                                                    <td>{{ $comment->post->title }}</td>
                                                    <td>{{ $comment->user->name }}</td>
                                                    <td>{{ $comment->formattingTheCreationDate($comment->created_at) }}</td>
                                                    <td>{{ $comment->formattingTheCreationDate($comment->updated_at) }}</td>
                                                    <td>
                                                        <a href="{{ route('comments.edit', ['comment' => $comment->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <form action="{{ route('comments.destroy', ['comment' => $comment->id]) }}" method="post" class="float-left">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger btn-sm"
                                                                    onclick="return confirm('Подтвердите удаление')">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </form>
                                                    </td>

                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <p>Комментариев пока нет...</p>
                                @endif
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                {{ $comments->links('vendor.pagination.bootstrap-4') }}
                            </div>
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

