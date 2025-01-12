<?php

namespace App\Http\Controllers;

use App\Models\UserMeasurement;
use App\Models\Customer;
use App\Models\BodyPart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserMeasurementController extends Controller
{
    public function index()
    {
        // Pobierz wszystkie pomiary
        $measurements = UserMeasurement::with('customer', 'bodyPart')->get();
        return view('user_measurements.index', compact('measurements'));
    }

    public function edit($id = 0)
    {
        // Pobierz istniejący pomiar lub stwórz nowy
        $measurement = UserMeasurement::findOrNew($id);
        $customers = Customer::all();  // Pobierz klientów
        $bodyParts = BodyPart::all();  // Pobierz części ciała

        if (request()->isMethod('post')) {
            $post = request()->all();
            $validator = validator($post, $measurement->rules());

            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $measurement->fill($post);
                    $measurement->save();
                    DB::commit();
                    return redirect()->route('user-measurements.index')->with('success', 'Pomyślnie zapisano pomiar.');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('user-measurements.index')->with('error', $e->getMessage());
                }
            }

            return redirect()->route('user-measurements.index')->with('error', $validator->getMessageBag()->all());
        }

        return view('user_measurements.edit', compact('measurement', 'customers', 'bodyParts'));
    }

    public function delete($id)
    {
        $measurement = UserMeasurement::findOrFail($id);
        $measurement->delete();

        return redirect()->route('user-measurements.index')->with('success', 'Usunięto pomiar.');
    }
}
