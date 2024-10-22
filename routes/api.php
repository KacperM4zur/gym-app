<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;

Route::get('/exercises-group', [ExercisesGroupController::class, 'getterExercisesGroup']);

Route::get('/exercises', [ExerciseController::class, 'getterExercises']);
Route::get('/exercises/group/{groupId}', [ExerciseController::class, 'getExercisesByGroup']);

Route::get('/supplements', [SupplementController::class, 'getterSupplements']);
Route::get('/supplements/group/{groupId}', [SupplementController::class, 'getSupplementsByGroup']);


Route::get('/supplements-group', [SupplementsGroupController::class, 'getterSupplementsGroup']);



Route::get('/body-parts', [BodyPartsController::class, 'getterBodyParts']);




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


Route::prefix('customer-profiles')->group(function () {
    Route::get('/', [CustomerProfileController::class, 'get']);
    Route::post('/', [CustomerProfileController::class, 'store']);
    Route::get('/{id}', [CustomerProfileController::class, 'show']);
    Route::put('/{id}', [CustomerProfileController::class, 'update']);
    Route::delete('/{id}', [CustomerProfileController::class, 'delete']);
});

Route::prefix('user-weights')->group(function () {
    Route::get('/', [UserWeightController::class, 'index']);
    Route::get('/{id}', [UserWeightController::class, 'show']);
    Route::post('/', [UserWeightController::class, 'store']);
    Route::put('/{id}', [UserWeightController::class, 'update']);
    Route::delete('/{id}', [UserWeightController::class, 'destroy']);
});

Route::prefix('user-measurements')->group(function () {
    Route::get('/', [UserMeasurementController::class, 'index']);
    Route::get('/{id}', [UserMeasurementController::class, 'show']);
    Route::post('/', [UserMeasurementController::class, 'store']);
    Route::put('/{id}', [UserMeasurementController::class, 'update']);
    Route::delete('/{id}', [UserMeasurementController::class, 'destroy']);
});

Route::prefix('user-max-lifts')->group(function () {
    Route::get('/', [UserMaxLiftController::class, 'index']);
    Route::get('/{id}', [UserMaxLiftController::class, 'show']);
    Route::post('/', [UserMaxLiftController::class, 'store']);
    Route::put('/{id}', [UserMaxLiftController::class, 'update']);
    Route::delete('/{id}', [UserMaxLiftController::class, 'destroy']);
});
