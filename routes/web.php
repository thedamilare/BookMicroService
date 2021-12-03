<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

Route::get('books', 'BookController@index');
Route::post('books', 'BookController@store');
Route::get('books/{book}', 'BookController@show');
Route::put('books/{book}', 'BookController@update');
Route::patch('books/{book}', 'BookController@update');
Route::delete('books/{book}', 'BookController@destroy');