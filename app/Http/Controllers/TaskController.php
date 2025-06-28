<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
   public function index()
    {
        $user = Auth::user();
        $search = request('search');
        $categoryFilter = request('category');
        $dueDateFilter = request('due_date'); // Add this line

        $query = Task::query();

        if ($user->hasRole('admin')) {
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                });
            }
        } else {
            $query->where('user_id', $user->id);
            
            if ($search) {
                $query->where(function($q) use ($search) {
                    $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
                });
            }
        }

        if ($categoryFilter) {
            $query->where('category_id', $categoryFilter);
        }

        // Add due date filter logic
        if ($dueDateFilter) {
            switch ($dueDateFilter) {
                case 'today':
                    $query->whereDate('due_date', today());
                    break;
                case 'this_week':
                    $query->whereBetween('due_date', [now()->startOfWeek(), now()->endOfWeek()]);
                    break;
                case 'next_week':
                    $query->whereBetween('due_date', [now()->addWeek()->startOfWeek(), now()->addWeek()->endOfWeek()]);
                    break;
                case 'overdue':
                    $query->where('due_date', '<', now())->where('status', '!=', 'completed');
                    break;
            }
        }

        $tasks = $query->with(['user', 'category'])
                    ->latest()
                    ->get();

        $categories = Category::all();

        return view('dashboard', compact('tasks', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('TaskPage.createTask', compact('categories'));
    }

    public function store(Request $request)
    {
        // get user data 
        $user = Auth::user();

        // get all categories

        // Validate and store the new task
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,in_progress',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task = new Task();
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->due_date = $request->input('due_date');
        $task->status = $request->input('status');
        $task->category_id = $request->input('category_id');
        $task->user_id = $user->id;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task)
    {

        $categories = Category::all();

        return view('TaskPage.updateTask', compact('task', 'categories'));
    }

    public function update(Request $request, Task $task)
    {
        // Validate and update the task
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date',
            'status' => 'required|in:pending,completed,in_progress',
            'category_id' => 'required|exists:categories,id',
        ]);

        $task->update($request->all());

        return redirect()->route('task.index')->with('success', 'Task updated successfully.');
    }

    public function destroy(Task $task)
    {
        // Delete the task
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Task deleted successfully.');
    }



    public function show(Task $task)
    {
        // Return the view to show a specific task
        return view('TaskPage.showTask', compact('task'));
    }
}
