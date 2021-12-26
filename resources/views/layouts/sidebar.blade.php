
<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
    <div class="sidebar">
        @if(!Request::is('/')) {{--Если страница '/' - блок не выводится--}}
            <div class="widget-no-style">
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
        @endif

        <div class="widget">
            <h2 class="widget-title">Popular Posts</h2>
            <div class="blog-list-widget">
                <div class="list-group">
                    @foreach($popular_posts as $post)
                        <a href="{{ route('article.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                            <div class="w-100 justify-content-between">
                                <img src="{{ $post->thumbnail }}" alt="" class="img-fluid float-left" >
                                <h5 class="mb-1">{{ $post->title }}</h5>
                                <small>{{ $post->formattingTheCreationDate($post->created_at) }} | </small>
                                <small><i class="fa fa-eye">{{ $post->views }}</i></small>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div><!-- end blog-list -->
        </div><!-- end widget -->

        <div class="widget">
            <h2 class="widget-title">Categories</h2>
            <div class="link-widget">
                <ul>
                    @foreach($categories_sidebar as $categories)
                    <li><a href="{{ route('category.single', ['slug' => $categories->slug]) }}">{{ $categories->title }}<span>{{ $categories->posts_count }}</span></a></li>
                    @endforeach
                </ul>
            </div><!-- end link-widget -->
        </div><!-- end widget -->
    </div><!-- end sidebar -->
</div><!-- end col -->
