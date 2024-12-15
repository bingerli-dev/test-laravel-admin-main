<?php

use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

if (env('API_ONLY') !== true) {
    Admin::routes();

    Route::group([
        'prefix' => config('admin.route.prefix'),
        'namespace' => config('admin.route.namespace'),
        'middleware' => config('admin.route.middleware'),
        'as' => config('admin.route.prefix') . '.',
    ], function (Router $router) {

        $router->get('/', 'HomeController@index')->name('home');
        $router->resource('api-keys', ApiKeyController::class);
    });
}