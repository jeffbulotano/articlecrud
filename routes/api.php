<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/articles', [ArticleController::class, 'index'])->name('articles');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('article');

Route::put('/articles/store', [ArticleController::class, 'store'])->name('articles.store');

Route::patch('/articles/update/{article}', [ArticleController::class, 'update'])->name('articles.update');

Route::delete('/articles/delete/{article}', [ArticleController::class, 'destroy'])->name('articles.delete');