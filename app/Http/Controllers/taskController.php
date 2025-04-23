<?php

namespace App\Http\Controllers;

use App\Models\task;
use Illuminate\Http\Request;

class taskController extends Controller
{
    public function index()
    {
        $tasks = task::all();
        return view('home.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'required|string|min:5',
        ]);

        task::create($request->all());
        return redirect('/')->with('success', 'Task has been added successfully');
    }

    public function edit($id)
    {
        $task = task::findOrFail($id);
        return view('home.edit', compact('task'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|min:5',
            'description' => 'required|string|min:5',
            'status' => 'required|string|in:pending,completed',
        ]);
        $tasks = task::findOrFail($id);
        $tasks->update($request->all());
        return redirect('/')->with('success', 'Task has been updated successfully');
    }

    public function destroy($id)
    {
        $tasks = task::findOrFail($id);
        $tasks->delete();
        return redirect('/')->with('success', 'Task has been deleted successfully');
    }
}
