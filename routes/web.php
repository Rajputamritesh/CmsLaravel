<?php
use App\Http\Controllers\Blog\PostsController;
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

Route::get('/','WelcomeController@index')->name('welcome');
Route::get('blog/posts/{post}',[PostsController::class,'show'])->name('blog.show');



Auth::routes();

Route::middleware(['auth'])->group(function () {
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('categories','CategoriesController');
Route::get('/category/{ category}', 'CategoriesController@del');

Route::resource('tags','TagsController');
Route::get('/tag/{tag}', 'TagsController@del');

Route::resource('posts','PostsController');

Route::get('/trashed', 'PostsController@trash')->name('something');//route name given 'something'
                                                                  //used as route('something',{id})
Route::get('post-restore/{id}', 'PostsController@restore')->name('post-restore');      

Route::get('user-index','UsersController@index')->name('users.index');
Route::post('user_changerole/{id}','UsersController@changerole')->name('change.role');
Route::get('user_profile/{id}','UsersController@profile')->name('profile');
Route::post('user_update/{id}','UsersController@update')->name('users.update');
});