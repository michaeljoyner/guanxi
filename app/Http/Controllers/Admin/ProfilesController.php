<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\UpdateProfileForm;
use App\People\Profile;
use App\Role;
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
        if(request()->user()->isSuperAdmin()) {
            $profiles = Profile::all();
        } else {
            $profiles = collect([request()->user()->profile]);
        }
        return view('admin.profiles.index')->with(compact('profiles'));
    }

    public function show(Profile $profile)
    {
        $roles = [
            'superadmin' => Role::superadmin()->id,
            'contributor' => Role::editor()->id
        ];
        return view('admin.profiles.show')->with(compact('profile', 'roles'));
    }

    public function edit(Profile $profile)
    {
        return view('admin.profiles.edit', ['profile' => $profile]);
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

        $this->flasher->success('Info Updated', 'Changes have been saved');

        return redirect('/admin/profiles/' . $profile->id);
    }

    public function delete(Profile $profile)
    {
        if(! $profile->hasUser()) {
            $profile->delete();
            $this->flasher->success('Profile deleted', 'That profile shall worry you no more.');

            return redirect('/admin/profiles');
        }

        $this->flasher->error('No can do!', 'That profile belongs to an actual user. You can delete the whole user');

        return redirect()->back();
    }
}
