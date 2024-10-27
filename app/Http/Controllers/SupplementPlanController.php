<?php

namespace App\Http\Controllers;

use App\Models\SupplementPlan;
use Illuminate\Http\Request;

class SupplementPlanController extends Controller
{
    // Wyświetlanie listy planów suplementacyjnych
    public function index()
    {
        $supplementPlans = SupplementPlan::all();
        return view('supplement_plans.index', compact('supplementPlans'));
    }

    // Wyświetlanie szczegółów konkretnego planu suplementacyjnego
    public function show($id)
    {
        $supplementPlan = SupplementPlan::with(['supplementPlanDays.supplementDetails.supplement', 'supplementPlanDays.day'])->findOrFail($id);
        return view('supplement_plans.show', compact('supplementPlan'));
    }
}
