<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserAvatarsController extends Controller
{
    public function store(Request $request, User $user)
    {
        $this->validate($request, ['file' => 'required|image']);

        $avatar = $user->setAvatar($request->file('file'));

        return response()->json($avatar->toArray());
    }
}
