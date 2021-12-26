<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Recent Posts</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($recent_posts as $post)
                            <a href="{{ route('article.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <img src="{{ $post->thumbnail }}" alt="" class="img-fluid float-left">
                                    <h5 class="mb-1">{{ $post->title }}</h5>
                                    <small>{{ $post->formattingTheCreationDate($post->created_at) }}</small>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular Posts</h2>
                    <div class="blog-list-widget">
                        <div class="list-group">
                            @foreach($popular_posts as $post)
                            <a href="{{ route('article.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="w-100 justify-content-between">
                                    <img src="{{ $post->thumbnail }}" alt="" class="img-fluid float-left">
                                    <h5 class="mb-1">{{ $post->title }}</h5>
                                    <span class="rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular Categories</h2>
                    <div class="link-widget">
                        <ul>
                            @foreach($categories_footer as $categories)
                                <li><a href="{{ route('category.single' , ['slug' => $categories->slug]) }}">{{ $categories->title }} <span>({{ $categories->posts_count }})</span></a></li>
                            @endforeach
                        </ul>
                    </div><!-- end link-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <br>
                @auth
                    <a class="copyright" href="{{ route('logout') }}">Выход</a>
                    @if(auth()->user()->is_admin)
                        <a class="copyright" href="{{ route('admin.index') }}"> | Админ</a>
                    @endif
                @else
                    <a class="copyright" href="{{ route('register.create') }}">Регистрация |</a>
                    <a class="copyright" href="{{ route('login.form') }}">Авторизация</a>
                @endauth
            </div>
        </div>
    </div><!-- end container -->
</footer><!-- end footer -->
