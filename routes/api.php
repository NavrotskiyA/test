<?php

use App\Http\Controllers\PostsController;
use App\Http\Controllers\TagsController;
use App\Http\Middleware\GetLocale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResource('{lang}/posts', PostsController::class)->middleware(GetLocale::class)->except('destroy');
Route::delete('posts/{id}', [PostsController::class, 'destroy'])->name('posts.destroy');
Route::apiResource('{lang}/tags', TagsController::class)
    ->middleware(GetLocale::class)
    ->except('show', 'update', 'destroy');
Route::get('tags/{id}', [TagsController::class,'show']);
Route::put('tags/{id}', [TagsController::class,'update']);
Route::delete('tags/{id}', [TagsController::class,'destroy']);


