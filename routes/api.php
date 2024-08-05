<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\CategoryController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    // Get all tasks
    Route::get('tasks', [TaskController::class, 'index']);
    
    // Get a specific task
    Route::get('tasks/{task}', [TaskController::class, 'show']);
    
    // Create a new task
    Route::post('tasks', [TaskController::class, 'store']);
    
    // Update a specific task
    Route::put('tasks/{task}', [TaskController::class, 'update']);
    
    // Delete a specific task
    Route::delete('tasks/{task}', [TaskController::class, 'destroy']);


    Route::get('categories-index', [CategoryController::class, 'index']);
    
    Route::get('categories/{category}', [CategoryController::class, 'show']);
    
    Route::post('categories', [CategoryController::class, 'store']);
   
    Route::put('categories/{category}', [CategoryController::class, 'update']);
   
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']);
});
