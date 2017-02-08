<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPagesController extends Controller
{

    public function show()
    {
        return view('admin.about.show')->with(AboutPage::getContent());
    }

    public function editStory()
    {
        return $this->sectionEditingView(AboutPage::story(true), 'story');
    }

    public function editMarketing()
    {
        return $this->sectionEditingView(AboutPage::marketing(true), 'marketing');
    }

    public function editEvents()
    {
        return $this->sectionEditingView(AboutPage::events(true), 'events');
    }

    public function editContribute()
    {
        return $this->sectionEditingView(AboutPage::contribute(true), 'contribute');
    }

    public function editContact()
    {
        return $this->sectionEditingView(AboutPage::contact(true), 'contact');
    }

    protected function sectionEditingView($content, $section)
    {
        return view('admin.about.edit')->with(compact('section', 'content'));
    }

    public function setStory(AboutPageForm $request)
    {
        AboutPage::setStory($request->storyContent());

        return redirect('admin/pages/about');
    }

    public function setMarketing(AboutPageForm $request)
    {
        AboutPage::setMarketing($request->marketingContent());

        return redirect('admin/pages/about');
    }

    public function setEvents(AboutPageForm $request)
    {
        AboutPage::setEvents($request->eventsContent());

        return redirect('admin/pages/about');
    }

    public function setContribute(AboutPageForm $request)
    {
        AboutPage::setContribute($request->contributeContent());

        return redirect('admin/pages/about');
    }

    public function setContact(AboutPageForm $request)
    {
        AboutPage::setContact($request->contactContent());

        return redirect('admin/pages/about');
    }
}
