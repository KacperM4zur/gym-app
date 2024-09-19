<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::name('exercises-group.')
        ->prefix('exercises-group')
        ->group(function (){
            Route::get('/', [ExercisesGroupController::class, 'index'])->name('index');
            Route::match(['get', 'post'],'/edit/{id?}', [ExercisesGroupController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [ExercisesGroupController::class, 'delete'])->name('delete');
        });
    Route::name('exercises.')
        ->prefix('exercises')
        ->group(function (){
            Route::get('/', [ExerciseController::class, 'index'])->name('index');
            Route::match(['get', 'post'],'/edit/{id?}', [ExerciseController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [ExerciseController::class, 'delete'])->name('delete');
        });
    Route::name('supplements-group.')
        ->prefix('supplements-group')
        ->group(function (){
            Route::get('/', [SupplementsGroupController::class, 'index'])->name('index');
            Route::match(['get', 'post'],'/edit/{id?}', [SupplementsGroupController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [SupplementsGroupController::class, 'delete'])->name('delete');
        });
    Route::name('supplements.')
        ->prefix('supplements')
        ->group(function (){
            Route::get('/', [SupplementController::class, 'index'])->name('index');
            Route::match(['get', 'post'],'/edit/{id?}', [SupplementController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [SupplementController::class, 'delete'])->name('delete');
        });
    Route::name('customers.')
        ->prefix('customers')
        ->group(function (){
            Route::get('/', [CustomerController::class, 'index'])->name('index');
            Route::match(['get', 'post'],'/edit/{id?}', [CustomerController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [CustomerController::class, 'delete'])->name('delete');
        });
    Route::name('roles.')
        ->prefix('roles')
        ->group(function () {
            Route::get('/', [RoleController::class, 'index'])->name('index');
            Route::match(['get', 'post'], '/edit/{id?}', [RoleController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
        });
    Route::name('days.')
        ->prefix('days')
        ->group(function () {
            Route::get('/', [DayController::class, 'index'])->name('index');
            Route::match(['get', 'post'], '/edit/{id?}', [DayController::class, 'edit'])->name('edit');
            Route::delete('/delete/{id}', [DayController::class, 'delete'])->name('delete');
        });
    Route::name('workout-plans.')
        ->prefix('workout-plans')
        ->group(function () {
            Route::get('/', [WorkoutPlanController::class, 'index'])->name('index');
            Route::get('/{id}', [WorkoutPlanController::class, 'show'])->name('show');
        });
    Route::name('posts.')
        ->prefix('posts')
        ->group(function () {
            Route::get('/', [PostController::class, 'index'])->name('index');
            Route::get('/{id}', [PostController::class, 'show'])->name('show');
        });


});

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
                ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});

//require __DIR__.'/auth.php';
