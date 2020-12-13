<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::whereHas("roles", function ($query) {
            $query->where("name", "user");
        })->paginate(5);

        return view('admin.permissions.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.permissions.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $user = User::findOrFail($id);

        if ($request->create_task == "on") {
            $user->givePermissionTo('create task');
        } elseif ($request->create_task == "off") {
            $user->revokePermissionTo('create task');
        }

        if ($request->edit_task == "on") {
            $user->givePermissionTo('edit task');
        } elseif ($request->edit_task == "off") {
            $user->revokePermissionTo('edit task');
        }

        if ($request->show_task == "on") {
            $user->givePermissionTo('show task');
        } elseif ($request->show_task == "off") {
            $user->revokePermissionTo('show task');
        }

        if ($request->destroy_task == "on") {
            $user->givePermissionTo('destroy task');
        } elseif ($request->destroy_task == "off") {
            $user->revokePermissionTo('destroy task');
        }

        return redirect()->route('admin.permissions.index')
            ->with('success', 'Permissions updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
