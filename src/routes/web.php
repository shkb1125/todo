<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CategoryController;

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
//     return view('welcome');
// });

Route::get('/', [TodoController::class, 'index']);
Route::get('/todos/search', [TodoController::class, 'search']);
Route::post('/todos', [TodoController::class, 'store']);
Route::patch('/todos/todo_id', [TodoController::class, 'update']);
Route::delete('/todos/todo_id', [TodoController::class, 'destroy']);

// カテゴリーの一覧表示
Route::get('/categories', [CategoryController::class, 'index']);
// カテゴリ新規作成
Route::post('/categories', [CategoryController::class, 'store']);
// カテゴリ更新
Route::PATCH('/categories/category_id', [CategoryController::class, 'update']);
// カテゴリ削除
Route::delete('/categories/category_id', [CategoryController::class, 'delete']);

