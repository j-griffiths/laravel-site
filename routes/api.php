<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('comments', CommentController::class, ['as' => 'api'])->middleware(['auth:sanctum']);

Route::get('/profiles/{id}', [ProfileController::class, 'apiShow'])->name('api.profiles.show')->middleware(['auth:sanctum']);

Route::post('/likes', [LikeController::class, 'store'])->name('api.likes.store')->middleware(['auth:sanctum']);

// This delete route uses post so that it can pass a request for validation. As likes are represented by a pivot table without an id of their own,
// a request to delete them must come with parameters which must be validated, before trying to find and delete an entry.
Route::post('/likes/delete', [LikeController::class, 'destroy'])->name('api.likes.destroy')->middleware(['auth:sanctum']);