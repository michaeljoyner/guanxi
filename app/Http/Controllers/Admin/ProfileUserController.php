<?php

namespace App\Http\Controllers\Admin;

use App\People\Profile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileUserController extends Controller
{
    public function store(Profile $profile)
    {
        $this->validate(request(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'role_id' => 'required|exists:roles,id'
        ]);

        User::registerNew(request(['name', 'email', 'password', 'role_id']), $profile);

        return redirect('/admin/profiles');
    }
}
