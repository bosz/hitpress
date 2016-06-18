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

Route::get('/', 'AdminPostsController@home');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::resource('admin/users','AdminUsersController');

//Route::group(['middleware'=>'admin'],function(){
//    Route::resource('admin/users','AdminUsersController');
//});



Route::get('/login',function(){
    if(Auth::check()){
        return redirect('admin');
    }else{
        return view('auth.login');
    }

});

Route::get('/admin',function(){
   return view('layouts.admin');
});

Route::get('/post/{id}',['as'=>'home.post','uses'=>'AdminPostsController@post']);

Route::resource('admin/post','AdminPostsController');

Route::resource('admin/category','CategoriesController');

Route::resource('admin/media','MediaController');

Route::resource('admin/comments','PostsCommentsController');

Route::resource('admin/comments/replies','CommentsRepliesController');

