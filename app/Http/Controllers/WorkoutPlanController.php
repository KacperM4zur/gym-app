<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\WorkoutPlan;

class WorkoutPlanController extends Controller
{
    public function index() {
        return view('workout-plan.index', [
            'workoutPlans' => WorkoutPlan::with('customer')->get()
        ]);
    }

    public function show($id) {
        // Znajdź plan treningowy wraz z powiązanymi dniami i ćwiczeniami
        $workoutPlan = WorkoutPlan::with([
            'workoutDays.day', // Ładuje dni przypisane do planu
            'workoutDays.workoutExercises.exercise' // Ładuje ćwiczenia przypisane do każdego dnia
        ])->findOrFail($id); // Pobiera plan na podstawie ID lub zwraca błąd 404

        // Przekaż dane do widoku 'workout-plan.show'
        return view('workout-plan.show', [
            'workoutPlan' => $workoutPlan
        ]);
    }



}
