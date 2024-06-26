<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Route;

Route::get('/exercises-group', [ExercisesGroupController::class, 'getterExercisesGroup']);

Route::get('/exercises', [ExerciseController::class, 'getterExercises']);

Route::get('/supplements', [SupplementController::class, 'getterSupplements']);

Route::get('/supplements-group', [SupplementsGroupController::class, 'getterSupplementsGroup']);

Route::post('/register', [CustomerController::class, 'register']);
