<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('users', UserController::class);
    $router->resource('categories', CategoryController::class);
    $router->resource('posts', PostController::class);

    $router->get('/api/users', 'PostController@users');
    $router->get('/api/categories', 'PostController@categories');
    $router->post('/upload_image','PostController@uploadImage');

});


