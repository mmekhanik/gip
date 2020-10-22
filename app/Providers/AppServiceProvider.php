<?php

namespace App\Providers;
use App\Models\Category;
use Cache;

use Illuminate\Support\ServiceProvider;
use Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use App\Repositories\Interfaces\ArticlesRepositoryInterface;
use App\Repositories\ArticlesRepository;
use Illuminate\Routing\UrlGenerator;
use App\Repositories\ElasticsearchRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       // if (config('blogger.search_engine.enabled')) {
       //      $this->commands([
       //          ImportCommand::class,
       //          FlushCommand::class,
       //      ]);

       //  }

        // $this->app->bind(
        //     ArticlesRepositoryInterface::class,
        //     ArticlesRepository::class
        // );

        $this->app->bind(ArticlesRepositoryInterface::class, function ($app) {
            // This is useful in case we want to turn-off our
            // search cluster or when deploying the search
            // to a live, running application at first.
            if (! config('blogger.search_engine.enabled')) {
                return new ArticlesRepository();
            }

            return new ElasticsearchRepository(
                $app->make(Client::class)
            );
        });
        $this->bindSearchClient();
    }
    private function bindSearchClient()
    {
        $this->app->bind(Client::class, function ($app) {
            return ClientBuilder::create()
                ->setHosts($app['config']->get('blogger.search.hosts'))
                ->build();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.breadcrumb','breadcrumb');

        view()->composer('layouts.blogside', function($view){
            // $recentPost = \App\Posts::recentPost();
            $archives=\App\Posts::archives();
            $tags=\App\Tag::has('posts')->pluck('name');
            $view->with(compact('archives', 'tags'));

        });

        view()->composer('partials._nav_categories', function ($view) {
            $view->with([
                'categories' => Cache::remember('top-five-categories', 600, function () {
                    return Category::getFiveMostPopularOnes();
                }),
                'numberOfCategories' => Cache::remember('number-of-categories', 600, function () {
                    return Category::all()->count();
                }),

            ]);
        });

 
        if(config('app.env') !== 'local') {
            URL::forceScheme('https');
        }

    }
}
