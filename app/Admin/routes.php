<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('single-reviews', 'SingleReviewController');
    $router->resource('discounts', 'DiscountController');
    $router->resource('blog-articles', 'BlogArticleController');
    $router->resource('comments', 'CommentController');
    $router->resource('emails', 'EmailController');


});
