<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UpdateProfileForm;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{

    public function index()
    {
        $profiles = Profile::all();
        return view('admin.profiles.index')->with(compact('profiles'));
    }

    public function show(Profile $profile)
    {
        return view('admin.profiles.show')->with(compact('profile'));
    }

    public function edit(Profile $profile)
    {
        $social_platforms = config('social.allowed_platforms');
        return view('admin.profiles.edit')->with(compact('profile', 'social_platforms'));
    }

    public function store(UpdateProfileForm $request)
    {
        $profile = Profile::createWithTranslations($request->requiredFields());

        return redirect('admin/profiles/' . $profile->id);
    }

    public function update(UpdateProfileForm $request, Profile $profile)
    {
        $profile->updateWithTranslations($request->requiredFields());

        $profile->updateSocialLinks($request->socialLinkFields());

        return redirect('/admin/profiles/' . $profile->id);
    }
}
