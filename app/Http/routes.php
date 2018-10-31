<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/* Route:
    1. pages.about and pages/about both are valid
    2. Route::get(), Route::post() and Route::delete() can be used in order to build REST API
*/
Route::get('/artisan', function(){
    return view('pages.artisan');
});

/* Dynamic Route:
1. Parameters can be passed with the route using bracket{} in Route File and slash(/) in URL route
    e.g. laravelapp/users/Brad will print 'This is user ID: Brad'
*/
Route::get('/dynamic/{name}/{id}', function ($name, $id){
    return 'This is user ' . $name . ' with ID: ' . $id;
});


/* Redirect Route to a Controller*/
Route::get('/', 'PagesController@index');
Route::get('/layouts', 'PagesController@layouts');
Route::get('/services', 'PagesController@services');
Route::get('/about/', 'PagesController@about');
Route::get('/controllers/', 'PagesController@controllers');
Route::resource('posts', 'PostsController');


Route::auth();

Route::get('/home', 'HomeController@index');
