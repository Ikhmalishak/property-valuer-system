<?php

namespace App\Http\Controllers;

use App\Models\Reminder;
use Illuminate\Http\Request;

class ReminderController extends Controller
{
    public function index()
    {
        $reminders = Reminder::with('user')->latest()->get();
        return view('reminders.index', compact('reminders'));
    }

    public function create()
    {
        return view('reminders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        Reminder::create($request->all());

        return redirect()->route('reminders.index')->with('success', 'Reminder created.');
    }
}
