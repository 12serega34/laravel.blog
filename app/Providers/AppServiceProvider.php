<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.sidebar', function ($view)
            {
               $view->with('popular_posts', Post::orderBy('views', 'desc')
                   ->limit(3)
                   ->get()); //через компановщик шаблонов создаем глобальные переменные, доступные в указанных шаблонах

               $view->with('categories_sidebar', Category::select(['title', 'slug'])
                    ->withCount('posts') //withCount считает количество связанных моделей для отношения, не загружая модели. Метод помещает атрибут {relation}_count в результирующие модели
                    ->orderBy('posts_count', 'desc')
                    ->get());
            });
        view()->composer('layouts.footer', function ($view)
        {
            $view->with('popular_posts', Post::orderBy('views', 'desc')
                ->limit(3)
                ->get());

            $view->with('recent_posts', Post::orderBy('created_at', 'desc')
                ->limit(3)
                ->get());

            $view->with('categories_footer', Category::select(['title', 'slug'])
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->get());
        });

        view()->composer('admin.layouts.layout', function ($view)
        {
            $view->with('userName', User::where('id', Auth::user()->id)->value('name'));
        });

        view()->composer('layouts.header', function ($view)
        {
            $view->with('categories', Category::select(['title', 'slug'])
                ->withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->limit(2)
                ->get());
        });
    }
}
