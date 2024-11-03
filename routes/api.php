<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ContactMessageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/exercises-group', [ExercisesGroupController::class, 'getterExercisesGroup']);

Route::get('/exercises', [ExerciseController::class, 'getterExercises']);
Route::get('/exercises/group/{groupId}', [ExerciseController::class, 'getExercisesByGroup']);

Route::get('/supplements', [SupplementController::class, 'getterSupplements']);
Route::get('/supplements/group/{groupId}', [SupplementController::class, 'getSupplementsByGroup']);


Route::get('/supplements-group', [SupplementsGroupController::class, 'getterSupplementsGroup']);



Route::get('/body-parts', [BodyPartsController::class, 'getterBodyParts']);
//Testowanie autoryzcacji
//Route::middleware('auth:api')->get('/body-parts', [BodyPartsController::class, 'getterBodyParts']);


Route::post('/contact-messages', [ContactMessageController::class, 'store']);


Route::post('/register', [CustomerController::class, 'register']);
Route::post('/login', [CustomerController::class, 'login']);

//Route::post('/create-workout-plan', [WorkoutPlanController::class, 'createWorkoutPlan']);
//Route::get('/workout-plans', [WorkoutPlanController::class, 'getWorkoutPlan']);

Route::middleware('auth:api')->group(function () {
    Route::post('/create-workout-plan', [WorkoutPlanController::class, 'createWorkoutPlan']);
    Route::get('/workout-plans', [WorkoutPlanController::class, 'getWorkoutPlan']);
    Route::post('/create-supplement-plan', [SupplementPlanController::class, 'createSupplementPlan']);
    Route::get('/supplement-plans', [SupplementPlanController::class, 'getSupplementPlan']);
    Route::get('/user-supplement-plans', [SupplementPlanController::class, 'getUserSupplementPlans']);
    Route::delete('/delete-supplement-plan/{id}', [SupplementPlanController::class, 'deleteSupplementPlan']);
    Route::get('/user-workout-plans', [WorkoutPlanController::class, 'getUserWorkoutPlans']);
    Route::delete('/delete-workout-plan/{id}', [WorkoutPlanController::class, 'deleteWorkoutPlan']);

});

Route::middleware('auth:api')->group(function () {
    Route::patch('/supplement-plans/{id}/activate', [SupplementPlanController::class, 'activate']);
    Route::patch('/workout-plans/{id}/activate', [WorkoutPlanController::class, 'activatePlan']);
});



Route::get('/days', [DayController::class, 'getDays']);

Route::get('/days', [DayController::class, 'getDays']);


Route::prefix('contact_messages')->middleware('auth:api')->group(function () {
    Route::get('/{senderId}/{receiverId}', [MessageController::class, 'getMessages']);
    Route::post('/send', [MessageController::class, 'sendMessage']);
});
Route::prefix('customers')->middleware('auth:api')->group(function () {
    Route::get('/trainers', [CustomerController::class, 'getTrainers']);
});
Route::middleware('auth:api')->get('/me', function (Request $request) {
    return response()->json($request->user());
});

Route::prefix('advices')->middleware('auth:api')->group(function () {
    Route::get('/', [AdviceController::class, 'getUserAdvices']);

});


Route::prefix('/posts')->middleware('auth:api')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/', [PostController::class, 'store']);
    Route::get('/{id}', [PostController::class, 'show']);
    Route::put('/{id}', [PostController::class, 'update']);
    Route::delete('/{id}', [PostController::class, 'delete']);
    Route::post('/{id}/comments', [CommentController::class, 'store']);
});


Route::prefix('advice')->group(function () {
    Route::get('/{customerId}', [AdviceController::class, 'index']);
    Route::post('/', [AdviceController::class, 'store']);
    Route::put('/{id}', [AdviceController::class, 'update']);
    Route::delete('/{id}', [AdviceController::class, 'delete']);
});

Route::prefix('customer-profiles')->group(function () {
    Route::get('/', [CustomerProfileController::class, 'get']);
    Route::post('/', [CustomerProfileController::class, 'store']);
    Route::get('/{id}', [CustomerProfileController::class, 'show']);
    Route::put('/{id}', [CustomerProfileController::class, 'update']);
    Route::delete('/{id}', [CustomerProfileController::class, 'delete']);
});

Route::prefix('user-weights')->middleware('auth:api')->group(function () {
    Route::get('/', [UserWeightController::class, 'index']); // Pobierz historię wag dla zalogowanego użytkownika
    Route::post('/', [UserWeightController::class, 'store']); // Dodaj nowy wpis wagowy dla zalogowanego użytkownika
});


Route::prefix('user-measurements')->middleware('auth:api')->group(function () {
    Route::get('/', [UserMeasurementController::class, 'index']); // Pobierz historię pomiarów
    Route::post('/', [UserMeasurementController::class, 'store']); // Dodaj nowy wpis pomiarowy
});


Route::prefix('user-max-lifts')->middleware('auth:api')->group(function () {
    Route::get('/', [UserMaxLiftController::class, 'index']); // Pobiera historię maksymalnych ciężarów
    Route::post('/', [UserMaxLiftController::class, 'store']); // Dodaje nowy maksymalny ciężar
});

