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
    Route::delete('/delete-supplement-plan/{id}', [SupplementPlanController::class, 'deleteSupplementPlan']);
    Route::delete('/delete-workout-plan/{id}', [WorkoutPlanController::class, 'deleteWorkoutPlan']);

});

Route::middleware('auth:api')->group(function () {
    Route::patch('/supplement-plans/{id}/activate', [SupplementPlanController::class, 'activate']);
    Route::patch('/workout-plans/{id}/activate', [WorkoutPlanController::class, 'activatePlan']);
    Route::get('/user-active-supplement-plan', [SupplementPlanController::class, 'getActiveSupplementPlan']);
    Route::get('/user-active-workout-plan', [WorkoutPlanController::class, 'getActiveWorkoutPlan']);
    Route::get('/user-workout-plans', [WorkoutPlanController::class, 'getUserWorkoutPlans']);
    Route::get('/user-supplement-plans', [SupplementPlanController::class, 'getUserSupplementPlans']);
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




Route::prefix('/posts')->middleware('auth:api')->group(function () {
    Route::get('/', [PostController::class, 'index']);
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

Route::middleware('auth:api')->prefix('customer-profile')->group(function () {
    Route::get('/me', [CustomerProfileController::class, 'getAuthenticatedProfile']);
    Route::post('/me', [CustomerProfileController::class, 'storeAuthenticatedProfile']);
    Route::put('/me', [CustomerProfileController::class, 'updateAuthenticatedProfile']);
    Route::delete('/me', [CustomerProfileController::class, 'deleteAuthenticatedProfile']);
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

Route::middleware('auth:api')->prefix('clients')->group(function () {
    Route::get('/', [CustomerController::class, 'getClients']);
    Route::get('/{id}/profile', [CustomerProfileController::class, 'getProfile']);
    Route::get('/{customerId}/active-supplement-plan', [SupplementPlanController::class, 'getActiveSupplementPlanForClient']);
    Route::get('/{customerId}/active-workout-plan', [WorkoutPlanController::class, 'getActiveWorkoutPlanForClient']);
    Route::get('/{trainerId}/{clientId}/messages', [MessageController::class, 'getConversationMessages']);
    Route::post('/{trainerId}/messages/send', [MessageController::class, 'sendTrainerMessage']);
    Route::get('/{customerId}/weights', [UserWeightController::class, 'getClientWeights']);
    Route::get('/{customerId}/measurements', [UserMeasurementController::class, 'getClientMeasurements']);
    Route::get('/{customerId}/max-lifts', [UserMaxLiftController::class, 'getClientMaxLifts']); // Nowy endpoint
    Route::get('/{customerId}/advices', [AdviceController::class, 'getClientAdvices']); // Pobierz notatki dla klienta
    Route::post('/{customerId}/advices', [AdviceController::class, 'createAdvice']); // Dodaj nową notatkę dla klienta
    Route::get('/{customerId}/supplement-plans', [SupplementPlanController::class, 'getSupplementPlansForClient']);
    Route::post('/{customerId}/supplement-plan', [SupplementPlanController::class, 'createSupplementPlanForClient']);
    Route::get('/{customerId}/supplement-plans', [SupplementPlanController::class, 'getClientSupplementPlans']);
    Route::get('/{customerId}/workout-plans', [WorkoutPlanController::class, 'getWorkoutPlansForClient']);
    Route::post('/{customerId}/workout-plans', [WorkoutPlanController::class, 'createWorkoutPlanForClient']);
    Route::get('/count', [CustomerController::class, 'getClientCount']);
    Route::get('/workout-plans/count', [WorkoutPlanController::class, 'getWorkoutPlanCount']);
    Route::get('/supplement-plans/count', [SupplementPlanController::class, 'getSupplementPlanCount']);


});

Route::prefix('advice')->group(function () {
    Route::get('/{customerId}', [AdviceController::class, 'index']);
    Route::post('/', [AdviceController::class, 'store']);
    Route::put('/{id}', [AdviceController::class, 'update']);
    Route::delete('/{id}', [AdviceController::class, 'delete']);
});

Route::prefix('advices')->middleware('auth:api')->group(function () {
    Route::get('/', [AdviceController::class, 'getUserAdvices']);

});


Route::middleware('auth:api')->group(function () {
    Route::get('/events', [EventController::class, 'index']);
    Route::post('/events', [EventController::class, 'store']);
    Route::get('/events/{id}', [EventController::class, 'show']);
    Route::put('/events/{id}', [EventController::class, 'update']);
    Route::delete('/events/{id}', [EventController::class, 'destroy']);
});
Route::middleware('auth:api')->group(function () {
    Route::get('/todos', [TodoController::class, 'index']);
    Route::post('/todos', [TodoController::class, 'store']);
    Route::put('/todos/{id}', [TodoController::class, 'update']);
    Route::delete('/todos/{id}', [TodoController::class, 'destroy']);
});
