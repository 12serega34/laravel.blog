@extends('layouts.layout')
@section('title', 'Тайтл для страницы тегов')
@section('content')
    <div class="page-title db">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <h2> Tag: {{ $tag->title }} <small class="hidden-xs-down hidden-sm-down">Nulla felis eros. </small></h2>
                </div><!-- end col -->
                <div class="col-lg-4 col-md-4 col-sm-12 hidden-xs-down hidden-sm-down">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('blog.single') }}">Blog</a></li>
                        <li class="breadcrumb-item active">{{ $tag->title }}</li>
                    </ol>
                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </div><!-- end page-title -->

    <section class="section lb">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    @include('layouts.sidebar')
                </div><!-- end col -->

                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
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
                    </div>

                    <hr class="invis">

                    {{ $posts->links('vendor.pagination.bootstrap-4') }}

                </div><!-- end col -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection

