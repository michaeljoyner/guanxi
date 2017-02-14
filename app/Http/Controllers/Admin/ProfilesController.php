<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\UpdateProfileForm;
use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{

    /**
     * @var Flasher
     */
    private $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

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

        $this->flasher->success('Bio Added', 'Let us welcome them to the team.');

        return redirect('admin/profiles/' . $profile->id);
    }

    public function update(UpdateProfileForm $request, Profile $profile)
    {
        $profile->updateWithTranslations($request->requiredFields());

        $profile->updateSocialLinks($request->socialLinkFields());

        $this->flasher->success('Info Updated', 'Changes have been saved');

        return redirect('/admin/profiles/' . $profile->id);
    }
}
