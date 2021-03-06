<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FolderController;
use Illuminate\Support\Facades\Auth;

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

Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::group(['middleware' => 'can:view,folder'], function() {
        //Route::get('/folders/{id}/tasks', 'App\Http\Controllers\TaskController@index')->name('tasks.index');
        Route::get('/folders/{folder}/tasks', [TaskController::class, 'index'])->name('tasks.index');  //laravel8以降のrouteの記述
        //Route::get('/folders/create', 'App\Http\Controllers\folderController@showCreateForm')->name('folders.create');
        Route::get('/folders/{folder}/tasks/create', [TaskController::class, 'showCreateForm'])->name('tasks.create');
        Route::post('/folders/{folder}/tasks/create', [TaskController::class, 'create']);
        Route::get('/folders/{folder}/tasks/{task_id}/edit', [TaskController::class, 'showEditForm'])->name('tasks.edit');
        Route::post('/folders/{folder}/tasks/{task_id}/edit', [TaskController::class, 'edit']);
    });
});
Route::get('/folders/create', [folderController::class, 'showCreateForm'])->name('folders.create'); //laravel8以降のrouteの記述
Route::post('/folders/create', [FolderController::class, 'create']); //laravel8以降のrouteの記述

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();
