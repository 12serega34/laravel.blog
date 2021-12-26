@extends('layouts.layout')
@section('title', 'Тайтл для одной страницы')
@section('content')
    <section class="section lb m3rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-title-area">
                            <ol class="breadcrumb hidden-xs-down">
                                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('category.single', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a></li>
                                <li class="breadcrumb-item active">{{ $post->title }}</li>
                            </ol>
                            <h3>{{ $post->title }}</h3>
                            <div class="blog-meta big-meta">
                                <small>{{ $post->formattingTheCreationDate($post->created_at) }}</small>
                                <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                            </div><!-- end meta -->
                        </div><!-- end title -->

                        @if(isset($post->thumbnail))
                            <div class="single-post-media">
                                <img src="{{ $post->thumbnail }}" alt="" class="img-fluid">
                            </div><!-- end media -->
                        @endif

                        <div class="blog-content">
                            {!! $post->content !!}
                        </div><!-- end content -->

                        <div class="blog-title-area">
                            @if($post->tags->count())
                            <div class="tag-cloud-single">
                                    <span>Tags</span>
                                @foreach($post->tags as $tag)
                                    <small><a href="{{ route('tag.single' ,['slug' => $tag->slug]) }}" title=""> {{ $tag->title }} </a></small>
                                @endforeach
                            </div><!-- end meta -->
                            @endif

                            <div class="post-sharing">
                                <ul class="list-inline">
                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>

                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i>
                                            <span class="down-mobile">Tweet on Twitter</span></a></li>
                                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div><!-- end post-sharing -->
                        </div><!-- end title -->


                        <hr class="invis1">

                        <div class="custombox clearfix">
                            <h4 class="small-title">You may also like</h4>
                            <div class="row">
                                @foreach($randomPost as $randPost)
                                    <div class="col-lg-6">
                                        <div class="blog-box">
                                            <div class="post-media">
                                                <a href="{{ route('article.single', ['slug' => $randPost->slug]) }}" title="">
                                                    <img src="{{$randPost->thumbnail}}" alt="" class="img-fluid">
                                                    <div class="hovereffect">
                                                        <span class=""></span>
                                                    </div><!-- end hover -->
                                                </a>
                                            </div><!-- end media -->
                                            <div class="blog-meta">
                                                <h4><a href="{{ route('article.single', ['slug' => $randPost->slug]) }}" title="">{{ $randPost->title }}</a></h4>
                                                <small><a href="{{ route('category.single', ['slug' => $randPost->category->slug]) }}" title="">{{ $randPost->category->title }}</a></small>
                                                <small>{{ $post->formattingTheCreationDate($randPost->created_at) }}</small>
                                            </div><!-- end meta -->
                                        </div><!-- end blog-box -->
                                    </div><!-- end col -->
                                @endforeach
                            </div><!-- end row -->
                        </div><!-- end custom-box -->

                        <hr class="invis1">
                        <div class="custombox clearfix">
                            <h4 class="small-title">Комментариев: {{ count($comments) }} </h4>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="comments-list">
                                        @foreach($comments as $comment)
                                        <div class="media">
                                            <a class="media-left" href="#">
                                                <img src="upload/author.jpg" alt="" class="rounded-circle">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading user_name">{{ $userName }}<small>5 days ago</small></h4>
                                                <p>{{ $comment->content }}</p>
                                                <a href="#" class="btn btn-primary btn-sm">Reply</a>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div><!-- end col -->
                            </div><!-- end row -->
                        </div><!-- end custom-box -->

                        <hr class="invis1">


                        @if ($errors->any())
                            <div class="alert alert-danger m-b-p">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (session()->has('success'))
                            <div class="alert alert-success m-b-p">
                                {{ session('success') }}
                            </div>
                        @endif


                        @auth
                            <div class="custombox clearfix">
                                <h4 class="small-title">Оставить комментарий</h4>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form class="form-wrapper" name="comment" method="post" action="{{ route('comments.store') }}">
                                            @csrf
                                            <textarea name="content" class="form-control" placeholder="Оставьте комментарий"></textarea>
                                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                                            <button type="submit" class="btn btn-primary">Отправить</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row">
                                <div class="col-lg-12">
                                    <h5>Оставлять комментарии могут только авторизованные пользователи</h5>
                                </div>
                                <div class="col-lg-12">
                                    <a href="{{ route('login.form') }}" class="btn btn-primary">Авторизоваться</a>
                                </div>
                            </div>
                        @endauth



                    </div><!-- end page-wrapper -->
                </div><!-- end col -->
                    @include('layouts.sidebar')
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
