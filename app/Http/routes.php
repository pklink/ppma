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

// Frontend
$app->get('/', function() {
    return view('index');
});

// Swagger
$app->get('/swagger/latest', 'SwaggerController@latest');

// Entries
$app->post('api/entries', 'EntryController@create');
$app->get('api/entries', 'EntryController@index');
$app->get('api/entries/{id}', 'EntryController@get');
$app->put('api/entries/{id}', 'EntryController@update');
$app->delete('api/entries/{id}', 'EntryController@delete');

// Categories
$app->post('api/categories', 'CategoryController@create');
$app->get('api/categories', 'CategoryController@index');
$app->get('api/categories/{id}', 'CategoryController@get');
$app->put('api/categories/{id}', 'CategoryController@update');
$app->delete('api/categories/{id}', 'CategoryController@delete');