@extends('layouts.layout')
@section('title', 'Тайтл для страницы поиска')
@section('content')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2> Search: {{ $search }}</h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Search</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section lb">
        <div class="container">
            <div class="row">
                @include('layouts.sidebar')

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">

                        @if($posts->isNotEmpty())
                            @foreach($posts as $post)
                                <div class="blog-custom-build">
                                    <div class="blog-box wow fadeIn">
                                        <div class="post-media">
                                            <a href="{{ route('article.single', ['slug' => $post->slug]) }}" title="">
                                                <img src="{{ $post->thumbnail }}" alt="" class="img-fluid">
                                                <div class="hovereffect">
                                                    <span></span>
                                                </div>
                                                <!-- end hover -->
                                            </a>
                                        </div>
                                        <!-- end media -->
                                        <div class="blog-meta big-meta text-center">
                                            <div class="post-sharing">
                                                <ul class="list-inline">
                                                    <li><a href="#" class="fb-button btn btn-primary"><i class="fa fa-facebook"></i> <span class="down-mobile">Share on Facebook</span></a></li>
                                                    <li><a href="#" class="tw-button btn btn-primary"><i class="fa fa-twitter"></i> <span class="down-mobile">Tweet on Twitter</span></a></li>
                                                    <li><a href="#" class="gp-button btn btn-primary"><i class="fa fa-google-plus"></i></a></li>
                                                </ul>
                                            </div><!-- end post-sharing -->
                                            <h4><a href="{{ route('article.single', ['slug' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
                                            <p>{{ $post->description }}</p>
                                            <small><a href="{{ route('category.single', ['slug' => $post->category->slug]) }}" title="">{{ $post->category->title }}</a></small>
                                            <small>{{ $post->formattingTheCreationDate($post->created_at) }}</small>
                                            <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                                        </div><!-- end meta -->
                                    </div><!-- end blog-box -->

                                    <hr class="invis">
                                </div>
                            @endforeach
                        @else
                            По запросу: <b>{{ $search }}</b> ничего не найдено.
                        @endif

                    </div>

                    <hr class="invis">

                    {{ $posts->appends(['search' => $search])->links('vendor.pagination.bootstrap-4') }} //appends(['search' => $search]) - добавляем дополнительный параметр к гет параметрам, чтобы каждый раз передавались данные об объекте поиска. Иначе вывода разных результатов на каждой странице не будет

                </div><!-- end col -->



            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection

