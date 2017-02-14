<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPageContributeController extends AboutPageContentController
{
    public function edit()
    {
        return $this->sectionEditingView(AboutPage::contribute(true), 'contribute');
    }

    public function update(AboutPageForm $request)
    {
        AboutPage::setContribute($request->contributeContent());

        $this->flasher->success('Content Updated', 'The contribute section has ben updated');

        return redirect('admin/pages/about');
    }
}
