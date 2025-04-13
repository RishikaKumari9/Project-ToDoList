<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TodoController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/create',[TodoController::class,'index'])->name('Todo.index');
Route::get('/list',[TodoController::class,'list'])->name('Todo.list');
Route::get('/update',[TodoController::class,'update'])->name('Todo.update');
Route::post('/upload',[TodoController::class,'upload'])->name('Todo.upload');
Route::get('/{id}/completed',[TodoController::class,'completed'])->name('Todo.completed');

Route::delete('/items/{id}', [TodoController::class, 'destroy'])->name('items.destroy');
