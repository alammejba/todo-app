@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Todo</h1>

    <!-- Form to Edit Todo -->
    <form action="{{ route('todos.update', $id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="todo" class="form-label">Edit Todo</label>
            <input type="text" name="todo" id="todo" class="form-control" value="{{ $todo }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update Todo</button>
        <a href="{{ route('todos.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
