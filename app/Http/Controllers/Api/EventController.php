<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Advice;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        // Pobierz wydarzenia zalogowanego trenera (customer o roli trenera)
        $events = Event::where('customer_id', Auth::id())->get();
        return response()->json(['status' => 200, 'events' => $events]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $event = Event::create([
            'customer_id' => Auth::id(), // Pobieranie zalogowanego użytkownika
            'title' => $validated['title'],
            'description' => $validated['description'],
            'date' => $validated['date'],
            'time' => $validated['time'],
        ]);

        return response()->json(['status' => 201, 'message' => 'Event created successfully', 'event' => $event]);
    }

    public function show($id)
    {
        $event = Event::where('customer_id', Auth::id())->findOrFail($id);
        return response()->json(['status' => 200, 'event' => $event]);
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('customer_id', Auth::id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $event->update($validated);

        return response()->json(['status' => 200, 'message' => 'Event updated successfully', 'event' => $event]);
    }

    public function destroy($id)
    {
        $event = Event::where('customer_id', Auth::id())->findOrFail($id);
        $event->delete();

        return response()->json(['status' => 200, 'message' => 'Event deleted successfully']);
    }
}
