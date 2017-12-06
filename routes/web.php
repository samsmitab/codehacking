<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

//auth section
Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/logout', 'Auth\LoginController@logout');


//home section
Route::get('/', function () {
    return view('welcome');
});



//public section

Route::get('/post/{id}', ['as'=>'home.post','uses'=>'AdminPostsController@post',['names'=>[

    'post'=>'post',

]]]);



//admin section

Route::group(['middleware'=>'admin'], function(){

    Route::get('/admin', function(){
        return view('admin.index');
    });

    Route::resource('admin/users','AdminUsersController',['names'=>[


        'index'=>'admin.users.index',
        'create'=>'admin.users.create',
        'store'=>'admin.users.store',
        'show'=>'admin.users.show',
        'edit'=>'admin.users.edit',
        'update'=>'admin.users.update',
        'destroy'=>'admin.users.destroy',



    ]]);

    Route::resource('admin/posts','AdminPostsController',['names'=>[


        'index'=>'admin.posts.index',
        'create'=>'admin.posts.create',
        'store'=>'admin.posts.store',
        'show'=>'admin.posts.show',
        'edit'=>'admin.posts.edit',
        'update'=>'admin.posts.update',
        'destroy'=>'admin.posts.destroy',



    ]]);

    Route::resource('admin/categories','AdminCategoriesController',['names'=>[


        'index'=>'admin.categories.index',
        'create'=>'admin.categories.create',
        'store'=>'admin.categories.store',
        'show'=>'admin.categories.show',
        'edit'=>'admin.categories.edit',
        'update'=>'admin.categories.update',
        'destroy'=>'admin.categories.destroy',



    ]]);

    Route::resource('admin/media', 'AdminMediasController',['names'=>[


        'index'=>'admin.media.index',
        'create'=>'admin.media.create',
        'store'=>'admin.media.store',
        'show'=>'admin.media.show',
        'edit'=>'admin.media.edit',
        'update'=>'admin.media.update',
        'destroy'=>'admin.media.destroy',



    ]]);


    Route::resource('admin/comments','PostCommentsController',['names'=>[


        'index'=>'admin.comments.index',
        'create'=>'admin.comments.create',
        'store'=>'admin.comments.store',
        'show'=>'admin.comments.show',
        'edit'=>'admin.comments.edit',
        'update'=>'admin.comments.update',
        'destroy'=>'admin.comments.destroy',



    ]]);

    Route::resource('admin/comment/replies','CommentRepliesController',['names'=>[


        'index'=>'admin.comment.replies.index',
        'create'=>'admin.comment.replies.create',
        'store'=>'admin.comment.replies.store',
        'show'=>'admin.comment.replies.show',
        'edit'=>'admin.comment.replies.edit',
        'update'=>'admin.comment.replies.update',
        'destroy'=>'admin.comment.replies.destroy',



    ]]);


});

//comment section

Route::group(['middleware'=>'auth'], function(){


    Route::post('comment/reply', 'commentRepliesController@createReply');



});