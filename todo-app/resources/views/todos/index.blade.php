@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todo List</h1>

    <!-- Form to Add a New Todo -->
    <form action="{{ route('todos.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="todo" class="form-label">New Todo</label>
            <input type="text" name="todo" id="todo" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Todo</button>
    </form>

    <!-- Display Todo List -->
    <h2 class="mt-4">Your Todos:</h2>
    <ul class="list-group">
        @forelse ($todos as $id => $todo)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{ $todo }}
                <span>
                    <!-- Edit Link -->
                    <a href="{{ route('todos.edit', $id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <!-- Delete Form -->
                    <form action="{{ route('todos.destroy', $id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </span>
            </li>
        @empty
            <li class="list-group-item">No todos found!</li>
        @endforelse
    </ul>
</div>
@endsection
