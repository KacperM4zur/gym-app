<?php

namespace App\Http\Controllers;

use App\Models\SupplementPlan;
use Illuminate\Http\Request;

class SupplementPlanController extends Controller
{
    public function index() {
        return view('supplement_plans.index', [
            'supplementPlans' => SupplementPlan::with('customer')->get()
        ]);
    }

    public function show($id) {
        // Znajdź plan treningowy wraz z powiązanymi dniami i ćwiczeniami
        $supplementPlan = SupplementPlan::with([
            'supplementPlanDays.day', // Ładuje dni przypisane do planu
            'supplementPlanDays.supplementDetails.supplement' // Ładuje ćwiczenia przypisane do każdego dnia
        ])->findOrFail($id); // Pobiera plan na podstawie ID lub zwraca błąd 404

        // Przekaż dane do widoku 'workout-plan.show'
        return view('supplement_plans.show', [
            'supplementPlan' => $supplementPlan
        ]);
    }
}
