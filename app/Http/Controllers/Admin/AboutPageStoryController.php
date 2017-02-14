<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPageStoryController extends AboutPageContentController
{
    public function edit()
    {
        return $this->sectionEditingView(AboutPage::story(true), 'story');
    }

    public function update(AboutPageForm $request)
    {
        AboutPage::setStory($request->storyContent());

        $this->flasher->success('Content Updated', 'The Story section has ben updated');

        return redirect('admin/pages/about');
    }
}
