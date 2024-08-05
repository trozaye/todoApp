<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        // Only get tasks and categories for the authenticated user
        $tasks = Auth::user()->tasks;
        $categories = Auth::user()->categories;
        return view('task', compact('tasks', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Task::create([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(), // Assign the authenticated user ID
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'priority' => 'required|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized action.');
        }

        $task->update([
            'name' => $request->name,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'priority' => $request->priority,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        // Ensure the task belongs to the authenticated user
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('tasks.index')->with('error', 'Unauthorized action.');
        }

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
