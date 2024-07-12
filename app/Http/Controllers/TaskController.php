<?php
namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TaskController;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        $categories = Category::all();
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
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }
}
