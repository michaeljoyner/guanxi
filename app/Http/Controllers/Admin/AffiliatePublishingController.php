<?php

namespace App\Http\Controllers\Admin;

use App\Affiliates\Affiliate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AffiliatePublishingController extends Controller
{
    public function update(Request $request, Affiliate $affiliate)
    {
        $this->validate($request, ['publish' => 'required|boolean']);

        $new_state = $request->publish ? $affiliate->publish() : $affiliate->retract();

        return response()->json(['new_state' => $new_state]);
    }
}
