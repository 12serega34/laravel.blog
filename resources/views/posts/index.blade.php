@extends('layouts.layout')
@section('title', 'Тайтл для главной страницы')
@section('content')
    <section id="cta" class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 align-self-center">
                    <h2>A digital marketing blog</h2>
                    <p class="lead"> Aenean ut hendrerit nibh. Duis non nibh id tortor consequat cursus at mattis felis. Praesent sed lectus et neque auctor dapibus in non velit. Donec faucibus odio semper risus rhoncus rutrum. Integer et ornare mauris.</p>
                    <a href="#" class="btn btn-primary">Try for free</a>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="newsletter-widget text-center align-self-center">
                        @if (session()->has('subscribe'))
                            <div class="m-b-md">
                                <h3>{{ session('subscribe') }}</h3>
                            </div>
                        @elseif($errors->any())
                            <div class="m-b-md" role="alert">
                                @foreach($errors->all() as $error)
                                    <h3>{{ $error }}</h3><br/>
                                @endforeach
                            </div>
                        @else
                            <h3>Подпишитесь сегодня!</h3>
                            <p>Подпишитесь на нашу еженедельную рассылку новостей и получайте обновления по Email.</p>
                            <form class="form-inline" method="post" action="{{ route('subscribe') }}">
                                @csrf
                                <input type="text" name="email" placeholder="Введите свой Email"
                                       class="form-control">
                                <input type="submit" value="Подписаться" class="btn btn-default btn-block" >
                            </form>
                        @endif
                    </div><!-- end newsletter -->
                </div>
            </div>
        </div>
    </section>

    <section class="section lb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-wrapper">
                        <div class="blog-custom-build">
                            @foreach($posts as $post)
                                <div class="blog-box wow fadeIn">
                                    <div class="post-media">
                                        <a href="{{ route('article.single', ['slug' => $post->slug]) }}" title="">
                                            <img src="{{ $post->thumbnail }}" alt="" class="img-fluid"> {{--можно использовать метод getImage в модели, чтобы если картинка есть - загружалась, а если нет, загружалась картинка no_image.jpg--}}
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
                            @endforeach

                            <hr class="invis">
                        </div>
                    </div>

                    <hr class="invis">

                    {{ $posts->links('vendor.pagination.bootstrap-4') }}
                </div><!-- end col -->

                @include('layouts.sidebar')

            </div><!-- end row -->
        </div><!-- end container -->
    </section>
@endsection
