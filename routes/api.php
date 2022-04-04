<?php

use App\Http\Controllers\Api\ToDoController;
use Illuminate\Support\Facades\Route;

Route::get('todos', [ToDoController::class, 'index']);
Route::post('todos/store/', [ToDoController::class, 'store']);
Route::post('todos/import/', [ToDoController::class, 'import']);
Route::get('todos/export/', [ToDoController::class, 'export']);
Route::patch('todos/{todo}/changeStatus', [ToDoController::class, 'changeStatus']);
Route::delete('todos/{todo}/destroy', [ToDoController::class, 'destroy']);
Route::get('todos/{todo}/show', [ToDoController::class, 'show']);
