<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\User;
use Auth;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch tasks assigned to the logged-in user if not admin
        $tasks = Auth::user()->is_admin 
            ? Tasks::orderBy('created_at', 'DESC')->get() 
            : Tasks::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->get();

        return view('tasks.index', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all(); // Get all users to assign tasks
        return view('tasks.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        Tasks::create($request->all());

        return redirect()->route('admin/tasks')->with('success', 'Task added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tasks = Tasks::findOrFail($id);

        return view('tasks.show', compact('tasks'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tasks = Tasks::findOrFail($id);
        $users = User::all(); // Get all users to reassign tasks

        return view('tasks.edit', compact('tasks', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tasks = Tasks::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'due_date' => 'nullable|date',
            'user_id' => 'required|exists:users,id',
        ]);

        $tasks->update($request->all());

        return redirect()->route('admin/tasks')->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tasks = Tasks::findOrFail($id);

        $tasks->delete();

        return redirect()->route('admin/tasks')->with('success', 'Task deleted successfully');
    }

    /**
     * Mark the specified task as completed.
     */
    public function complete(string $id)
    {
        $tasks = Tasks::findOrFail($id);

        $tasks->update(['is_completed' => true]);

        return redirect()->route('admin/tasks')->with('success', 'Task marked as completed');
    }
}


