<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Settings;
use App\Models\Tag;
use App\Models\User;
use App\Album;
use App\Photo;
use App\Service;
use Cache;
//use View;

class DashboardController extends Controller
{

    public function index()
    {
        $dashboard = [
            'number_of_users' => $this->getNumberOfUsers(),
            'number_of_albums' => $this->getNumberOfAlbums(),
            'number_of_photos' => $this->getNumberOfPhotos(),
            'number_of_articles' => $this->getNumberOfArticles(),
            'number_of_services' => $this->getNumberOfServices(),
            'number_of_categories' => $this->getNumberOfCategories(),
            'number_of_tags' => $this->getNumberOfTags(),
            'search_engine_enabled' => config('blogger.search_engine.enabled'),
            'disqus_enabled' => (empty(Settings::getDisqusShortname()) === true) ? 0 : 1,
            'google_analytics_enabled' => (empty(Settings::getGoogleAnalyticsId()) === true) ? 0 : 1,
            'site_enabled' => (app()->isDownForMaintenance() != true),
        ];

        // return View::make('backend.dashboard.index', compact('dashboard'));
        return view('backend.dashboard.index', compact('dashboard'));
    }

    private function getNumberOfUsers()
    {
        return Cache::remember('users', 10, function () {
            return User::all()->count();
        });
    }

    private function getNumberOfArticles()
    {
        return Cache::remember('articles', 10, function () {
            return Article::all()->count();
        });
    }

    private function getNumberOfAlbums()
    {
        return Cache::remember('albums', 10, function () {
            return Album::all()->count();
        });
    }
    private function getNumberOfServices()
    {
        return Cache::remember('services', 10, function () {
            return Service::all()->count();
        });
    }
    private function getNumberOfPhotos()
    {
      
        return Cache::remember('photos', 10, function () {
            // return Photo::all()->count();
            $user = auth()->user();
            $admin=$user->hasRole('superadministrator|administrator');
            if($admin)
                return Photo::all()->count();
            else
                return $user->photos()->count();
            });
    }

    private function getNumberOfCategories()
    {
        return Cache::remember('categories', 10, function () {
            return Category::all()->count();
        });
    }

    private function getNumberOfTags()
    {
        return Cache::remember('tags', 10, function () {
            return Tag::all()->count();
        });
    }

}
