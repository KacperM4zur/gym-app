<?php

namespace App\Http\Controllers;

use App\Models\Advice;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdviceController extends Controller
{
    public function index() {
        $advices = Advice::all();
        return view('advices.index', ['advices' => $advices]);
    }

    public function edit($id = 0) {
        $advice = Advice::findOrNew($id);
        $customers = Customer::all();

        if (request()->isMethod('post')) {
            $post = request()->all();
            $validator = validator($post, $advice->rules());

            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $advice->fill($post);
                    $advice->save();
                    DB::commit();
                    return redirect()->route('advices.index')->with('success', 'Porada została zapisana.');
                } catch (\Exception $e) {
                    DB::rollBack();
                    return redirect()->route('advices.index')->with('error', $e->getMessage());
                }
            }
            return redirect()->route('advices.index')->with('error', $validator->getMessageBag()->all());
        }

        return view('advices.edit', [
            'advice' => $advice,
            'customers' => $customers
        ]);
    }

    public function delete($id) {
        $advice = Advice::findOrFail($id);
        $advice->delete();
        return redirect()->route('advices.index')->with('success', 'Porada została usunięta.');
    }
}

