<?php

namespace App\Http\Controllers\Admin\Api;

use App\People\Profile;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfilesController extends Controller
{
    public function index()
    {
        return Profile::all()->map(function($profile) {
            return [
                'id' => $profile->id,
                'name' => $profile->name,
                'intro' => $profile->getTranslation('intro', 'en'),
                'thumbnail' => $profile->avatar('thumb')
            ];
        });
    }
}
