<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Task;

class DashboardController extends Controller
{
    public function index()
    {
        $total = Task::all();
        $task = Task::paginate(5);

        $pending = count($total->where('status', 'pending'));
        $inprogress = count($total->where('status', 'inprogress'));
        $completed = count($total->where('status', 'completed'));

        return view('admin.dashboard', compact('task', 'total', 'pending', 'inprogress', 'completed'));
    }
}
