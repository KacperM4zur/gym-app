<?php

namespace App\Http\Controllers\Api;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::where('customer_id', Auth::id())->get();
        return response()->json(['todos' => $todos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo = Todo::create([
            'customer_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return response()->json(['todo' => $todo], 201);
    }

    public function update(Request $request, $id)
    {
        $todo = Todo::where('id', $id)->where('customer_id', Auth::id())->firstOrFail();
        $todo->update($request->only('title', 'description', 'completed'));

        return response()->json(['todo' => $todo]);
    }

    public function destroy($id)
    {
        $todo = Todo::where('id', $id)->where('customer_id', Auth::id())->firstOrFail();
        $todo->delete();

        return response()->json(['message' => 'Todo deleted successfully']);
    }
}
