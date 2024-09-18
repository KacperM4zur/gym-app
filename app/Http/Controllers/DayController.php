<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class DayController extends Controller
{
    public function index() {
        return view('days.index', [
            'days' => Day::all()
        ]);
    }

    public function edit($id = 0)
    {
        $day = Day::findOrNew($id);
        $isNew = !$day->exists;

        if (request()->isMethod('post')) {
            $post = request()->all();
            $redirect = redirect()->route('days.index');

            $validator = validator($post, [
                'name' => 'required|string|max:255',
                'number' => [
                    'required',
                    'integer',
                    Rule::unique('days', 'number')->ignore($day->id),
                ],
            ]);

            if ($validator->passes()) {
                DB::beginTransaction();
                try {
                    $day->fill($post);
                    $day->save();

                    DB::commit();
                } catch (\Exception $exception) {
                    DB::rollBack();

                    return $redirect->with('error', ["{$exception->getMessage()}"]);
                }

                $message = $isNew ? 'Pomyślnie dodano ' . $day->name : 'Pomyślnie edytowano ' . $day->name;
                return $redirect->with('success', [$message]);
            }

            return $redirect->with('error', $validator->getMessageBag()->all());
        }

        return view('days.edit', [
            'day' => $day
        ]);
    }
    public function delete($id = 0) {
        $day = Day::findOrFail($id);
        $day->delete();

        return redirect()->route('days.index')->with('success', ["Usunięto $day->name"]);
    }
}
