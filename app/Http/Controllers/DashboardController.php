<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $tasks = Task::with('user')->get(); // Pastikan relasi user sudah ada
        return view('dashboard', compact('categories', 'tasks'));
    }
}