<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;

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

//Route::get('/folders/{id}/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
Route::get('/folders/{id}/tasks', [TaskController::class, 'index'])->name('tasks.index');  //laravel8以降のrouteの記述
//Route::get('/folders/create', 'App\Http\Controllers\folderController@showCreateForm')->name('folders.create');
Route::get('/folders/create', [folderController::class, 'showCreateForm'])->name('folders.create'); //laravel8以降のrouteの記述
Route::post('/folders/create', [FolderController::class, 'create']); //laravel8以降のrouteの記述
Route::get('/folders/{id}/tasks/create', [TaskController::class, 'showCreateForm'])->name('tasks.create');
Route::post('/folders/{id}/tasks/create', [TaskController::class, 'create']);
Route::get('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'showEditForm'])->name('tasks.edit');
Route::post('/folders/{id}/tasks/{task_id}/edit', [TaskController::class, 'edit']);