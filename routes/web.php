<?php
use Gipirion\User;
use Gipirion\Notifications\NewFollower;
use App\Mail\ContactForm;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->name('home');
Route::get('/', 'HomeController@welcome')->name('home');
Route::get('/home', 'HomeController@index');
Route::get('/about1', function () {
    return view('about1');
});

//$stripe = resolve('\Gipirion\Billing\Stripe');
// dd($stripe);

// Auth::routes();
// Route::get('/login', 'SessionsController@create')->name('login');
// Route::post('/login', 'SessionsController@store');
// Route::get('/logout', 'SessionsController@destroy');
// Route::post('/logout', 'SessionsController@destroy')->name('logout');
// Route::get('/register', 'RegistrationController@create')->name('register');
// Route::post('/register', 'RegistrationController@store');

/* 
| ==========================
|  Authenticate Routes
| ==========================
*/


Route::get('/register','AuthController@resgisterShow')->name('register');
Route::post('/register','AuthController@resgisterStore');
Route::get('/login','AuthController@loginShow')->name('login');
Route::post('/login','AuthController@loginStore');
Route::get('/logout', 'AuthController@logout');
Route::post('/logout','AuthController@logout')->name('logout');
Route::get('/verify/{token}','AuthController@verify')->name('verify');
Route::get('/verify-again','AuthController@verifyAgain')->name('verifyAgain');
Route::put('/verify-again','AuthController@resendVerification');

/* 
| ==========================
|  Password Reset Routes
| ==========================
*/

Route::get('/password/reset','AuthController@passwordResetToken')->name('passwordResetToken');
Route::post('/password/reset','AuthController@passwordResetTokenSend');

Route::get('/password/reset/update/{token?}','AuthController@passwordReset')->name('passwordReset');
Route::post('/password/reset/update','AuthController@passwordResetUpdate');



Route::get('/post', 'PostsController@blog')->name('blog');
Route::get('/post/create', 'PostsController@create');
Route::post('/post', 'PostsController@store');
Route::get('/post/{slug}', 'PostsController@show');

Route::post('/post/{slug}/comments', 'CommentsController@store');
Route::get('/post/tag/{tag}', 'TagsController@index');



Route::get('/u/{user}', 'ProfileController@index');

Route::post('/follow', 'ProfileController@followOrUnfollowUser')->name('follow');

Route::get('/x', function(){
	// $user=Auth::user();
	// $user->notify(new NewFollower(User::findOrFail(2)));
	foreach (Auth::user()->unreadNotifications as $notification) {
		//dd($notification);
		$notification->markAsRead();
	}
});
Route::get('/test', function(){
	$user=Auth::user();
	//dd($user);
	$f=Auth::user()->isFollowing($user);
	dd($f);
	echo 'lksjd';
});

/*
|--------------------------------------------------------------------------
| Front-end routes
|--------------------------------------------------------------------------
 */

Route::get("articles", ['as' => 'frontend.articles', 'uses' => 'Frontend\ArticleController@index']);
Route::get('article/{slug}', ['as' => 'frontend.articles.show', 'uses' => 'Frontend\ArticleController@show'])->where('slug', '[\w\d\-\_]+');
Route::get("sitemap", ['as' => 'frontend.sitemap', 'uses' => 'Frontend\HomepageController@sitemap']);
Route::get("terms-and-conditions", ['as' => 'frontend.terms-and-conditions', 'uses' => 'Frontend\HomepageController@termsAndConditions']);
Route::get("privacy-policy", ['as' => 'frontend.privacy-policy', 'uses' => 'Frontend\HomepageController@privacyPolicy']);

Route::post('subscribe', 'Frontend\HomepageController@subscribe');
Route::get('subscription/confirm/{email}', ['as' => 'frontend.subscription', 'uses' => 'Frontend\HomepageController@subscriptionConfirm']);

Route::get("categories", ['as' => 'frontend.categories', 'uses' => 'Frontend\CategoryController@index']);
Route::get("categories/{slug}", ['as' => 'frontend.categories.show', 'uses' => 'Frontend\CategoryController@show'])->where('slug', '[\w\d\-\_]+');

Route::get("tags", ['as' => 'frontend.tags', 'uses' => 'Frontend\TagController@index']);
Route::get("tags/{slug}", ['as' => 'frontend.tags.show', 'uses' => 'Frontend\TagController@show'])->where('slug', '[\w\d\-\_]+');

Route::post('contact', 'Frontend\HomepageController@contact');
Route::get('about', ['as' => 'frontend.about', 'uses' => 'Frontend\HomepageController@about']);
Route::get('about/{slug}', ['as' => 'frontend.about.author', 'uses' => 'Frontend\HomepageController@author'])->where('slug', '[\w\d\-\_]+');
Route::get('search', ['as' => 'frontend.search', 'uses' => 'Frontend\HomepageController@search']);


Route::get('autocomplete', 'Frontend\HomepageController@autocomplete');

Route::post("favourites", 'Frontend\ArticleController@favourites')->middleware('auth');


Route::get('/albums', 'FrontendController@albums')->name('albums');
Route::get('/homepage', 'FrontendController@home')->name('homepage');
Route::get('/gallery/{slug}', 'FrontendController@gallery')->name('gallery');
Route::get('/aboutus', 'FrontendController@about')->name('about');
Route::get('/contactacl', 'FrontendController@contact')->name('contactacl');
Route::post('/contactacl', 'FrontendController@contactForm');
Route::get('/service', 'FrontendController@service')->name('service');

Route::get('/mail', function(){
    
    $data = [
        "fname" => "Marina",
        "lname" => "Mekhanik",
        "email" => "mmekhanik@gmail.com",
        "subject" => "Contact",
        "message" => "Hello Marina",
    ];
    return new ContactForm($data);
});

use App\Repositories\Interfaces\ArticlesRepositoryInterface;

Route::get('/srch', function (\App\Repositories\Interfaces\ArticlesRepositoryInterface $repository) {
    $articles = $repositry->search('mo');

    dd($articles);
});

Route::get('/enter/{age}/{name}',function($age,$name){  
    $client = Elasticsearch\ClientBuilder::create()->build();   //connect with the client
    $params = array();
    $params['body']  = array(   
      'name' => $name,                                          //preparing structred data
      'age' => $age
      
    );
    $params['index'] = 'beyblade';
    $params['type']  = 'BeyBlade_Owner';
    $result = $client->index($params);                          //using Index() function to inject the data
    var_dump($result);
});

Route::get('findtest/{age}',function($age){
    $client = Elasticsearch\ClientBuilder::create()->build();       //connect to the client
    $params['index'] = 'beyblade';                      // Preparing Indexed Data
    $params['type'] = 'BeyBlade_Owner';                             
    $params['body']['query']['match']['age'] = $age;            //Find data in which age matches given input
    $result = $client->search($params);                 //Using Search function
return($result);                                    //Printing out result
});
Route::group(['prefix' => 'filemanager', 'middleware' => 'role:superadministrator|administrator|user'], function () {
     \UniSharp\LaravelFilemanager\Lfm::routes();
    Route::get('show', 'FilemanagerLaravelController@getShow');
   //  Route::post('laravel-filemanager/upload', '\Unisharp\Laravelfilemanager\controllers\UploadController@upload');
    // \UniSharp\LaravelFilemanager\Lfm::routes();

});
Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function (){

    \UniSharp\LaravelFilemanager\Lfm::routes();

});

Route::group(['middleware' => ['auth'], 'prefix' => 'dashboard'], function () {

    //auth only
    Route::get('/', ['as' => 'backend.dashboard', 'uses' => 'Backend\DashboardController@index']);
    Route::get('profile', ['as' => 'backend.profile', 'uses' => 'Backend\ProfileController@edit']);
    Route::put('profile', 'Backend\ProfileController@update');

    Route::get('profilereset', ['as' => 'backend.profilereset', 'uses' => 'Backend\ProfileController@reset']);
    Route::put('profilereset', 'Backend\ProfileController@passupdate');

    Route::get('favourite-articles', ['as' => 'articles.favourites', 'uses' => 'Backend\ArticleController@favouriteArticles']);

    Route::get('avatar', ['as' => 'backend.avatar', 'uses' => 'Backend\AvatarController@edit']);
    Route::post('avatar', 'Backend\AvatarController@update');

    Route::resource('albums','Backend\AlbumController');
    Route::get('photos/create/{album_id}', 'Backend\PhotoController@create')->name('photos.create');

    Route::resource('photos','Backend\PhotoController');
    //admin only
    Route::group(['middleware' => 'role:superadministrator|administrator'], function () {
        Route::resource('users', 'Backend\UserController');
        Route::resource('permissions','Backend\PermissionController');
        Route::resource('roles','Backend\RoleController');
        Route::resource('services','Backend\ServiceController');
        Route::resource('contacts','Backend\ContactController');
       

        Route::get('tools', ['as' => 'backend.tools', 'uses' => 'Backend\ToolsController@index']);
        Route::post('clear-cache', 'Backend\ToolsController@clearCache');
        Route::post('maintenance-mode', 'Backend\ToolsController@maintenanceMode');
        Route::post('reset-search-index', 'Backend\ToolsController@resetIndex');

        Route::get('impersonate/{id}', 'Backend\ImpersonificationController@impersonate');
        Route::get('settings', ['as' => 'backend.settings', 'uses' => 'Backend\SettingsController@index']);
        Route::post('settings/update', 'Backend\SettingsController@update');
    });

    //admin and editor
    Route::group(['middleware' => 'role:superadministrator|administrator|user'], function () {
        Route::resource('categories', 'Backend\CategoryController');
        Route::resource('tags', 'Backend\TagController');
        Route::resource('articles', 'Backend\ArticleController');
        Route::get('manager', 'Backend\MediaController@manager');
        Route::get('preview/{id}', 'Backend\ArticleController@preview');
    });

    Route::get('back-to-admin-mode', 'Backend\ImpersonificationController@backToAdminMode');
    Route::get('subscriptions', ['as' => 'backend.subscriptions', 'uses' => 'Backend\SubscriptionController@index']);

    Route::get('media', ['as' => 'backend.media', 'uses' => 'Backend\MediaController@index']);
});

Route::group(['prefix'=>'/admin'],function(){

    Route::resource('/album','AlbumController');
    Route::resource('/photo','PhotoController');
    Route::resource('/team','TeamController');
    Route::resource('/settings','SettingController');
    Route::resource('/service','ServiceController');
    Route::resource('/contactinfo','ContactInfoController');
    Route::resource('/permission','PermissionController');
    Route::resource('/role','RoleController');
    //Route::resource('/articles', 'Backend\ArticleController');

    /*=================
      | User Settings 
    ====================*/

    Route::resource('/user','UserController');
    Route::get('/profile','UserController@profile')->name('user.profile');
    Route::put('/profile','UserController@profile_update')->name('user.profile_update');
    Route::get('/password/update','UserController@password_update')->name('user.password_update');
    Route::post('/password/update','UserController@passwordResetUpdate');

});

Route::get('/{token}/{id}', 'UserController@newUserPassSet')->name('new.user');

Route::get('/admin', 'HomeController@dashboard')->name('dash');





