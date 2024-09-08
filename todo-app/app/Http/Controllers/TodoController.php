<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    // Display the list of todos
    public function index(Request $request)
    {
        $todos = $request->session()->get('todos', []);
        return view('todos.index', compact('todos'));
    }

    // Store a new todo
    public function store(Request $request)
    {
        $request->validate([
            'todo' => 'required|string|max:255',
        ]);

        $todo = $request->input('todo');
        $todos = $request->session()->get('todos', []);
        $todos[] = $todo;
        $request->session()->put('todos', $todos);

        return redirect()->route('todos.index');
    }

    // Show the edit form for a specific todo
    public function edit(Request $request, $id)
    {
        $todos = $request->session()->get('todos', []);
        if (!isset($todos[$id])) {
            return redirect()->route('todos.index')->withErrors('Todo not found');
        }

        $todo = $todos[$id]; // Get the todo to edit
        return view('todos.edit', compact('todo', 'id'));
    }

    // Update a specific todo
    public function update(Request $request, $id)
    {
        $request->validate([
            'todo' => 'required|string|max:255',
        ]);

        $todos = $request->session()->get('todos', []);
        if (!isset($todos[$id])) {
            return redirect()->route('todos.index')->withErrors('Todo not found');
        }

        // Update the todo value
        $todos[$id] = $request->input('todo');
        $request->session()->put('todos', $todos);

        return redirect()->route('todos.index');
    }

    // Delete a specific todo
    public function destroy(Request $request, $id)
    {
        $todos = $request->session()->get('todos', []);
        unset($todos[$id]);
        $request->session()->put('todos', $todos);

        return redirect()->route('todos.index');
    }
}
