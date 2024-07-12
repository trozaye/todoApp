@extends('layout')

@section('title', 'Categories')

@section('content')
<div class="container mt-5">
    <h2>Create a New Category</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <h3 class="mt-4">Assign Existing Tasks to the New Category</h3>
        
        <div class="form-group">
            <label for="tasks">Select Tasks</label>
            <select name="tasks[]" id="tasks" class="form-control" multiple>
                @foreach ($tasks as $task)
                    <option value="{{ $task->id }}">{{ $task->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Category and Assign Tasks</button>
    </form>
</div>
@endsection
