<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AnalyticController;

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

Route::get('/dashboard', function () {
    return redirect()->route('posts.index');
})->middleware(['auth'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::resources([
        'posts' => PostController::class, 
        //'users' => ProfileController::class
    ]);
});

Route::get('/analytics', [AnalyticController::class, 'index'])->name('analytics.index');

Route::get('/posts/share/facebook/{exampleText}', [PostController::class, 'shareToFacebook'])->name('services.facebook.share');

require __DIR__.'/auth.php';
