<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('single-reviews', 'SingleReviewController@index');
Route::get('single-reviews/top', 'SingleReviewController@topReviews');
Route::get('single-reviews/{slug}', 'SingleReviewController@getReview');
Route::get('discounts', 'DiscountController@index');
Route::get('discounts/top', 'DiscountController@topDiscounts');
Route::get('/', 'BlogArticleController@index');
Route::get('blog-article', 'BlogArticleController@headArticle');
Route::get('blog-articles/all', 'BlogArticleController@getAll');
Route::get('blog-articles/popular', 'BlogArticleController@getPopular');
Route::get('blog-articles/latest', 'BlogArticleController@getLatest');
Route::get('blog-articles/{slug}', 'BlogArticleController@getArticle');
Route::get('comments/{commentType}/{id}', 'CommentController@index');
Route::post('comments/create', 'CommentController@store');
Route::post('emails/save', 'EmailController@store');
Route::get('sidebar-banners', 'SidebarBannerController@index');
Route::get('search', 'SearchController@search');

Route::get('show-review-image/{slug}', 'SingleReviewController@getImage');
Route::get('show-logo-image/{slug}', 'SingleReviewController@getLogoImage');
Route::get('show-article-image/{slug}', 'BlogArticleController@getImage');
Route::get('show-discount-image/{id}', 'DiscountController@getImage');