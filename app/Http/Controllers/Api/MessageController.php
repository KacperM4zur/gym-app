<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Customer;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function getMessages($senderId, $receiverId, Request $request)
    {
        $user = $request->user(); // Pobieramy aktualnie zalogowanego użytkownika

        // Sprawdzamy, czy zalogowany użytkownik jest częścią konwersacji
        if ($user->id != $senderId && $user->id != $receiverId) {
            return response()->json(['message' => 'Brak dostępu do tej konwersacji'], 403);
        }

        $messages = Message::where(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $senderId)
                ->where('receiver_id', $receiverId);
        })->orWhere(function ($query) use ($senderId, $receiverId) {
            $query->where('sender_id', $receiverId)
                ->where('receiver_id', $senderId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }


    public function sendMessage(Request $request)
    {
        $user = $request->user(); // Pobieramy aktualnie zalogowanego użytkownika

        $request->validate([
            'receiver_id' => 'required|exists:customers,id',
            'message' => 'required|string',
        ]);

        // Tworzymy wiadomość z aktualnym użytkownikiem jako nadawcą
        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }

    public function getConversationMessages($trainerId, $clientId, Request $request)
    {
        $user = $request->user(); // Get the currently authenticated user

        // Check if the authenticated user is part of the conversation
        if ($user->id != $trainerId && $user->id != $clientId) {
            return response()->json(['message' => 'You do not have access to this conversation'], 403);
        }

        $messages = Message::where(function ($query) use ($trainerId, $clientId) {
            $query->where('sender_id', $trainerId)
                ->where('receiver_id', $clientId);
        })->orWhere(function ($query) use ($trainerId, $clientId) {
            $query->where('sender_id', $clientId)
                ->where('receiver_id', $trainerId);
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages);
    }

    public function sendTrainerMessage(Request $request)
    {
        $user = $request->user(); // Get the currently authenticated user

        $request->validate([
            'receiver_id' => 'required|exists:customers,id', // Ensure receiver exists in customers table
            'message' => 'required|string', // Validate that message is a string
        ]);

        // Create a new message with the authenticated user as the sender
        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        return response()->json($message);
    }


}
