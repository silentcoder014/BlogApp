<?php

//Home
Route::get('/', 'HomeController@index')->name('home');
//Article
Route::get('article', 'ArticleController@index')->name('articles');
Route::get('article/{articleId}', 'ArticleController@show')->name('get-article');
Route::get('confirm-comment/{commentId}/{token}', 'CommentController@confirmComment')->name('confirm-comment');
Route::get('category/article/{categoryAlias}', 'CategoryController@getArticles')->name('articles-by-category');

Route::get('search', 'ArticleController@search')->name('search-article');
//Comment
Route::post('comment/{articleId}', 'CommentController@store')->name('add-comment');

//Category
Route::get('category/{categoryId}', 'CategoryController@show')->name('get-category');

//Admin auth
Route::get('admin/login', 'AuthController@showLoginForm')->name('loginForm');
Route::post('admin/login', 'AuthController@login')->name('login');
Route::get('admin/logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['customAuth', 'role:owner|admin']], function(){
    //admin category
    Route::get('admin/category', 'CategoryController@index')->name('categories');
    Route::get('admin/category/toggle-active/{categoryId}', 'CategoryController@toggleActive')->name('toggle-category-active');
    Route::put('admin/category/{categoryId}', 'CategoryController@update')->name('update-category');
    Route::post('admin/category', 'CategoryController@store')->name('add-category');
    Route::get('admin/category/{categoryId}/delete', 'CategoryController@destroy')->name('delete-category');

    //Admin users
    Route::get('admin/user', 'UserController@index')->name('users');
    Route::get('admin/user/{userId}/delete', 'UserController@destroy')->name('delete-user');
    Route::put('admin/user/change-password', 'UserController@changePassword')->name('change-password');

    //Admin keywords
    Route::post('admin/keyword', 'KeywordController@store')->name('add-keyword');
    Route::get('admin/keyword', 'KeywordController@index')->name('keywords');
    Route::get('admin/keyword/toggle-active/{keywordId}', 'KeywordController@toggleActive')->name('toggle-keyword-active');
    Route::put('admin/keyword/{keywordId}', 'KeywordController@update')->name('update-keyword');
    Route::get('admin/keyword/{keywordId}/delete', 'KeywordController@destroy')->name('delete-keyword');
});

Route::group(['middleware' => ['customAuth', 'role:owner|admin|author']], function(){
    //admin articles
    Route::get('admin/dashboard', 'DashboardController@index')->name('admin-dashboard');
    Route::get('admin/article', 'ArticleController@adminArticle')->name('admin-articles');
    Route::get('admin/article/toggle-publish/{articleID}', 'ArticleController@togglePublish')->name('toggle-article-publish');
    Route::get('admin/article/{articleId}/delete', 'ArticleController@destroy')->name('delete-article');
    Route::get('admin/article/create', 'ArticleController@create')->name('create-article');
    Route::post('article', 'ArticleController@store')->name('store-article');
    Route::get('article/{articleId}/edit', 'ArticleController@edit')->name('edit-article');
    Route::put('article/{articleId}', 'ArticleController@update')->name('update-article');

    //Admin comments
    Route::get('admin/comment', 'CommentController@index')->name('comments');
    Route::get('admin/comment/{commentId}/delete', 'CommentController@destroy')->name('delete-comment');
    Route::get('admin/comment/toggle-publish/{commentId}', 'CommentController@togglePublish')->name('toggle-comment-publish');
    Route::put('admin/comment/{commentId}', 'CommentController@update')->name('update-comment');
});