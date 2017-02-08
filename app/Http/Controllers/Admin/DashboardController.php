<?php

namespace App\Http\Controllers\Admin;

use App\Weather\Weather;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function home()
    {
        $weatherLocations = Weather::availableLocations();
        return view('admin.dashboard')->with(compact('weatherLocations'));
    }
}
