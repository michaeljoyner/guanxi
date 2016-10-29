<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\PasswordResetFormRequest;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminPasswordController extends Controller
{
    public function edit(User $user)
    {
        return view('admin.users.passwords.edit')->with(compact('user'));
    }

    public function update(PasswordResetFormRequest $request, User $user)
    {
        if(! Hash::check($request->current_password, Auth::user()->password)) {
            return abort(403, 'You do not have permission to change this password.');
        }

        $user->resetPassword($request->password);

        return redirect('/admin');
    }
}
