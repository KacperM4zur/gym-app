<?php

namespace App\Http\Controllers;

use App\Models\UserMaxLift;
use App\Models\Customer;
use App\Models\Exercise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserMaxLiftController extends Controller
{
    public function index()
    {
        return view('user_max_lifts.index', [
            'maxLifts' => UserMaxLift::with('customer', 'exercise')->get()
        ]);
    }

    public function edit($id = 0)
    {
        $maxLift = UserMaxLift::findOrNew($id); // Znajdź lub stwórz nowy wpis
        $customers = Customer::all();
        $exercises = Exercise::all();

        if (request()->isMethod('post')) {
            $post = request()->all();
            $validator = validator($post, $maxLift->rules()); // Walidacja

            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $maxLift->fill($post); // Wypełnij danymi
                    $maxLift->save(); // Zapisz w bazie
                    DB::commit();
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('user-max-lifts.index')->with('error', ["Błąd podczas zapisu: " . $e->getMessage()]);
                }

                return redirect()->route('user-max-lifts.index')->with('success', ['Pomyślnie zapisano wpis.']);
            }

            return redirect()->route('user-max-lifts.index')->with('error', $validator->getMessageBag()->all());
        }

        return view('user_max_lifts.edit', [
            'maxLift' => $maxLift,
            'customers' => $customers,
            'exercises' => $exercises
        ]);
    }

    public function delete($id)
    {
        $maxLift = UserMaxLift::findOrFail($id);
        $maxLift->delete();

        return redirect()->route('user-max-lifts.index')->with('success', ['Pomyślnie usunięto wpis.']);
    }
}
