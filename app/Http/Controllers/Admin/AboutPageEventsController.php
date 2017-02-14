<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AboutPageForm;
use App\Pages\AboutPage;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPageEventsController extends AboutPageContentController
{
    public function edit()
    {
        return $this->sectionEditingView(AboutPage::events(true), 'events');
    }

    public function update(AboutPageForm $request)
    {
        AboutPage::setEvents($request->eventsContent());

        $this->flasher->success('Content Updated', 'The events section has ben updated');

        return redirect('admin/pages/about');
    }
}
