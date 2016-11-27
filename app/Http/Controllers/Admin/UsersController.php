<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        $roles = collect([Role::superadmin(), Role::editor(), Role::writer()]);
        $users = User::all();
        return view('admin.users.index')->with(compact('roles', 'users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show')->with(compact('user'));
    }

    public function edit(User $user)
    {
        $roles = collect([Role::superadmin(), Role::editor(), Role::writer()]);
        return view('admin.users.edit')->with(compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email',
            'role_id' => 'required|exists:roles,id'
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        $user->assignRole(Role::findOrFail($request->role_id));

        return redirect('admin/users/' . $user->id);
    }

    public function delete(User $user)
    {
        $user->delete();

        return redirect('admin/users');
    }
}
