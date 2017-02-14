<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPageMarketingController extends AboutPageContentController
{
    public function edit()
    {
        return $this->sectionEditingView(AboutPage::marketing(true), 'marketing');
    }

    public function update(AboutPageForm $request)
    {
        AboutPage::setMarketing($request->marketingContent());

        $this->flasher->success('Content Updated', 'The marketing section has ben updated');

        return redirect('admin/pages/about');
    }
}
