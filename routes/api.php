<?php

use App\Http\Controllers\Api\ToDoController;
use Illuminate\Support\Facades\Route;

Route::apiResource('todos', ToDoController::class);
Route::patch('todos/{todo}/changeStatus', [ToDoController::class, 'changeStatus']);
