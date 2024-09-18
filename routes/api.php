<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;

Route::get('/exercises-group', [ExercisesGroupController::class, 'getterExercisesGroup']);

Route::get('/exercises', [ExerciseController::class, 'getterExercises']);

Route::get('/supplements', [SupplementController::class, 'getterSupplements']);

Route::get('/supplements-group', [SupplementsGroupController::class, 'getterSupplementsGroup']);

Route::post('/register', [CustomerController::class, 'register']);
Route::post('/login', [CustomerController::class, 'login']);

Route::post('/create-workout-plan', [WorkoutPlanController::class, 'createWorkoutPlan']);
Route::get('/workout-plans', [WorkoutPlanController::class, 'getWorkoutPlan']);

Route::get('/days', [DayController::class, 'getDays']);

Route::get('/days', [DayController::class, 'getDays']);

Route::prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'get']);
    Route::post('/', [PostController::class, 'store']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'delete']);
    Route::post('/{id}/comments', [CommentController::class, 'store']);
});
