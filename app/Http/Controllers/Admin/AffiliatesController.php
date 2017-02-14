<?php

namespace App\Http\Controllers\Admin;

use App\Affiliates\Affiliate;
use App\Http\FlashMessaging\Flasher;
use App\Http\Requests\AffiliateForm;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AffiliatesController extends Controller
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
        $affiliates = Affiliate::all();

        return view('admin.affiliates.index')->with(compact('affiliates'));
    }

    public function show(Affiliate $affiliate)
    {
        return view('admin.affiliates.show')->with(compact('affiliate'));
    }

    public function edit(Affiliate $affiliate)
    {
        $social_platforms = config('social.allowed_platforms');
        return view('admin.affiliates.edit')->with(compact('affiliate', 'social_platforms'));
    }

    public function store(AffiliateForm $request)
    {
        $affiliate = Affiliate::createWithTranslations($request->requiredFields());

        $this->flasher->success('New Affiliate Added', 'The affiliate has been added to the system');

        return redirect('admin/affiliates/' . $affiliate->id . '/edit');
    }

    public function update(AffiliateForm $request, Affiliate $affiliate)
    {
        $affiliate->updateWithTranslations($request->requiredFields());

        $affiliate->updateSocialLinks($request->socialLinkFields());

        $this->flasher->success('Affiliate Updated', 'Your changes have been saved');

        return redirect('admin/affiliates/' . $affiliate->id);
    }

    public function delete(Affiliate $affiliate)
    {
        $affiliate->delete();

        $this->flasher->success('Affiliate Deleted', 'All gone');

        return redirect('admin/affiliates');
    }
}
