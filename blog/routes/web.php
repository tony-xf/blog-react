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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//$router->post('hello/{string}', 'ExampleController@hello');
//$router->post('hello/{string}', 'ExampleController@hello');
$router->post('article/add', 'ArticleController@add');
$router->get('article/all', 'ArticleController@all');

$router->post('article_category/add', 'ArticleCategoryController@add');
$router->put('article_category/edit/{id}', 'ArticleCategoryController@edit');
$router->delete('article_category/del/{id}', 'ArticleCategoryController@del');
$router->get('article_category/all', 'ArticleCategoryController@all');
