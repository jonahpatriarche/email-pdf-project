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

use App\Post;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

Route::get('/', function () {

    return redirect(route('posts.index'));
});

Route::get('posts', function (Request $request, Post $post) {

    return view('posts.index')
        ->with('posts', Post::all());

})->name('posts.index');

Route::get('posts/{post}', function (Request $request, Post $post) {

    return view('posts.show')
        ->with('post', $post);

})->name('posts.show');

Route::post('email/post', 'EmailsController@postPdf')->name('email.post');


Route::get('posts/{post}/pdf', 'PostsController@pdf')->name('posts.pdf');
/*Route::get('posts', 'PostsController@index')->name('posts.index');
Route::get('posts/{post}', 'PostsController@show')->name('posts.show');*/
