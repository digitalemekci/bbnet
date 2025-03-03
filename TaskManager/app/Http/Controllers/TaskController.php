<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $tasks = Auth::user()->tasks()->orderBy('created_at', 'desc')->get();
        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Auth::user()->tasks()->create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task başarıyla oluşturuldu.');
    }

    public function edit(Task $task)
    {
        $this->authorizeTaskAccess($task);
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $this->authorizeTaskAccess($task);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task güncellendi.');
    }

    public function complete(Task $task)
    {
        $this->authorizeTaskAccess($task);

        $task->update(['is_completed' => true]);

        return redirect()->route('tasks.index')->with('success', 'Task tamamlandı.');
    }

    public function destroy(Task $task)
    {
        $this->authorizeTaskAccess($task);

        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task silindi.');
    }

    private function authorizeTaskAccess(Task $task)
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Bu göreve erişim izniniz yok.');
        }
    }
}
