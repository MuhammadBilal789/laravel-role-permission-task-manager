<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:show task', ['only' => ['show']]);
        $this->middleware('permission:edit task', ['only' => ['edit']]);
        $this->middleware('permission:create task', ['only' => ['create']]);
        $this->middleware('permission:destroy task', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $task = Auth::user()->tasks()->paginate(5);
        return view('user.tasks.index', compact('task'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        Task::create([
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'status' => $request->status,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('user.tasks.index')->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        return view('user.tasks.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        return view('user.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $task->update($request->all());

        return redirect()->route('user.tasks.index')
            ->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);
        $task->delete();

        return redirect()->route('user.tasks.index')
            ->with('success', 'Task deleted successfully');
    }

    public function search(Request $request)
    {
        $term = $request->term;

        $task = Task::where('user_id', auth()->user()->id)
            ->where(function ($query) use ($term) {
                $query->where('name', 'LIKE', '%' . $term . '%')
                    ->orWhere('category', 'LIKE', '%' . $term . '%')
                    ->orWhere('description', 'LIKE', '%' . $term . '%')
                    ->orWhere('status', 'LIKE', '%' . $term . '%');
            })->paginate(5);

        $task->appends(['term' => $term]);
        return view('user.tasks.search', compact('task', 'term'));
    }
}
