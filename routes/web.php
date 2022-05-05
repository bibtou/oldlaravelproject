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

// Route::get('/', function () {
    // return view('welcome');
// });

//Route::get('/{blog_page?}', 'BlogController@articles')->defaults('blog_page', 1);


// Route::get('/article', function() { abort('404'); });



Route::get('/', 'BlogController@articles')
	->defaults('page', 1)
	->name('blog.home');
	
	/*
Route::get('/page/{page}', 'BlogController@articles')
	// ->where('page', '^([0-9]+)$')
	->defaults('page', 1)
	->name('blog.page');
*/
Route::get('/article/{article_slug}', 'BlogController@article')
	// ->where('article_slug', '^[0-9a-z\-]+$')
	->name('blog.article');

Route::get('/categorie/{category_slug}', 'BlogController@category')
	->name('blog.category');

Route::get('/archives/{year}/{month}', 'BlogController@archive')
	->name('blog.archive');

Route::get('/search', 'BlogController@search')
	->name('blog.search');

Route::post('/change-status', 'BlogController@articleByStatus')
	->name('blog.article-by-status');

// Route::get('/wp-admin', 'EasterEggController@wpAdmin')
	// ->name('easterEgg.wpAdmin');

Auth::routes();
Auth::routes(['register' => true]);

Route::get('/home', 'HomeController@index')->name('home');



Route::namespace('Admin')->middleware('auth')->prefix('gestion/blog')->group(function() {
	Route::get('/', 'AdminController@index')->name('blog.admin.home');

	Route::resource('article', 'ArticleController')->names([
		'store' => 'blog.admin.article.store',
		'index' => 'blog.admin.article.index',
		'create' => 'blog.admin.article.create',
		'show' => 'blog.admin.article.show',
		'update' => 'blog.admin.article.update',
		'destroy' => 'blog.admin.article.destroy',
		'edit' => 'blog.admin.article.edit'
	]);

	Route::resource('categorie', 'CategoryController')->parameters(
		['categorie' => 'category']
	)->names([
		'store' => 'blog.admin.category.store',
		'index' => 'blog.admin.category.index',
		'create' => 'blog.admin.category.create',
		'show' => 'blog.admin.category.show',
		'update' => 'blog.admin.category.update',
		'destroy' => 'blog.admin.category.destroy',
		'edit' => 'blog.admin.category.edit'
	]);

	Route::resource('utilisateur', 'UserController')->parameters(
		['utilisateur' => 'user']
	)->names([
		'store' => 'blog.admin.user.store',
		'index' => 'blog.admin.user.index',
		'create' => 'blog.admin.user.create',
		'show' => 'blog.admin.user.show',
		'update' => 'blog.admin.user.update',
		'destroy' => 'blog.admin.user.destroy',
		'edit' => 'blog.admin.user.edit'
	]);


	Route::resource('page', 'ResourcePageController')->names([
		'store' => 'blog.admin.resource-page.store',
		'index' => 'blog.admin.resource-page.index',
		'create' => 'blog.admin.resource-page.create',
		'show' => 'blog.admin.resource-page.show',
		'update' => 'blog.admin.resource-page.update',
		'destroy' => 'blog.admin.resource-page.destroy',
		'edit' => 'blog.admin.resource-page.edit'
	]);

	Route::resource('bloc', 'ResourceBlockController')->parameters(
		['bloc' => 'block']
	)->names([
		'store' => 'blog.admin.resource-block.store',
		'index' => 'blog.admin.resource-block.index',
		'create' => 'blog.admin.resource-block.create',
		'show' => 'blog.admin.resource-block.show',
		'update' => 'blog.admin.resource-block.update',
		'destroy' => 'blog.admin.resource-block.destroy',
		'edit' => 'blog.admin.resource-block.edit'
	]);
});

Route::namespace('Resource')->middleware('auth')->prefix('ressource')->group(function() {
	Route::get('/liste', 'HomeController@index')->name('resource.index');

	Route::get('/page/{page_id}/{page_slug}', 'ResourcePageController@pageWithSlug')
		->where('page_id', '[0-9]+')
		->where('page_slug', '[a-z0-9\-]+')
		->name('blog.admin.resource-page.page-with-slug');

	Route::get('/{resource_page_from_block}-{page_id}-{block_link_position}/{block_slug}/{page_slug}', 'HomeController@show')
		->where('resource_page_from_block', '[0-9]+')
		->where('page_id', '[0-9]+')
		->where('block_link_position', '[0-9]+')
		->where('block_slug', '[a-z0-9\-]+')
		->where('page_slug', '[a-z0-9\-]+')
		->name('resource.show');
});

