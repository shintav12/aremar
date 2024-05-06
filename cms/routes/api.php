<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'categories'] , function(){
    Route::get('','api\CategoriesController@getCategories');
    Route::get('{slug}','api\CategoriesController@getCategoryBySlug');
});

Route::group(['prefix' => 'sections'] , function(){
    Route::get('','api\SectionController@getSections');
    Route::get('{slug}','api\SectionController@getSectionBySlug');
});

 Route::group(['prefix' => 'users'] , function(){
     Route::post('login','api\UserController@login');
     Route::post('','api\UserController@createUser');
     Route::get('{id}','api\UserController@getUser')->middleware('api_auth');
     Route::post('{id}','api\UserController@updateUser')->middleware('api_auth');
});



