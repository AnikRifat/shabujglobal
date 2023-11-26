<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.pages.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.pages.users.view', compact('roles'));
    }

    public function store(Request $request)
    {

        User::create($request->all());

        return redirect()->route('admin.users.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('admin.pages.users.view', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only(['name', 'email', 'role']));

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');
    }
}
