<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPageContactController extends AboutPageContentController
{
    public function edit()
    {
        return $this->sectionEditingView(AboutPage::contact(true), 'contact');
    }

    public function update(AboutPageForm $request)
    {
        AboutPage::setContact($request->contactContent());

        $this->flasher->success('Content Updated', 'The contact section has ben updated');

        return redirect('admin/pages/about');
    }
}
