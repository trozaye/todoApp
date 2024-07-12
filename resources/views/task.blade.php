@extends('layout')
@section('title', 'Task Manager')
@section('content')

<h1>Task Manager</h1>

<!-- Create Task Form -->
<h2>Create Task</h2>
<form action="{{ route('tasks.store') }}" method="POST">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input type="text" name="name" id="title" required> <!-- Updated name attribute -->
    </div>
    <div>
        <label for="description">Description:</label>
        <textarea name="description" id="description"></textarea>
    </div>
    <div>
        <label for="due_date">Due Date:</label>
        <input type="date" name="due_date" id="due_date" required>
    </div>
    <div>
        <label for="priority">Priority:</label>
        <input type="text" name="priority" id="priority" required>
    </div>
    <div>
        <label for="category_id">Category:</label>
        <select name="category_id" id="category_id">
            <option value="">No Category</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
    <button type="submit">Create Task</button>
</form>

<!-- Task List -->
<h2>Tasks</h2>
@if (session('success'))
    <div>{{ session('success') }}</div>
@endif
<ul>
    @foreach ($tasks as $task)
        <li>
            <strong>{{ $task->name }}</strong> <!-- Updated to use 'name' instead of 'title' -->
            <p>{{ $task->description }}</p>
            <p>Due Date: {{ $task->due_date }}</p>
            
            <!-- Edit Task Form -->
            <form action="{{ route('tasks.update', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
                <div>
                    <label for="title-{{ $task->id }}">Title:</label>
                    <input type="text" name="name" id="title-{{ $task->id }}" value="{{ $task->name }}" required> <!-- Updated name attribute -->
                </div>
                <div>
                    <label for="description-{{ $task->id }}">Description:</label>
                    <textarea name="description" id="description-{{ $task->id }}">{{ $task->description }}</textarea>
                </div>
                <div>
                    <label for="due_date-{{ $task->id }}">Due Date:</label>
                    <input type="date" name="due_date" id="due_date-{{ $task->id }}" value="{{ $task->due_date }}" required>
                </div>
                <div>
                    <label for="priority-{{ $task->id }}">Priority:</label>
                    <input type="text" name="priority" id="priority-{{ $task->id }}" value="{{ $task->priority }}" required>
                </div>
                <div>
                    <label for="category_id-{{ $task->id }}">Category:</label>
                    <select name="category_id" id="category_id-{{ $task->id }}">
                        <option value="">No Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" {{ $task->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit">Update Task</button>
            </form>

            <!-- Delete Task Form -->
            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </li>
    @endforeach
</ul>

@endsection
