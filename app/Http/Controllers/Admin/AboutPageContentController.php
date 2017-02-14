<?php

namespace App\Http\Controllers\Admin;

use App\Http\FlashMessaging\Flasher;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class AboutPageContentController extends Controller
{

    /**
     * @var Flasher
     */
    protected $flasher;

    public function __construct(Flasher $flasher)
    {
        $this->flasher = $flasher;
    }

    protected function sectionEditingView($content, $section)
    {
        return view('admin.about.edit')->with(compact('section', 'content'));
    }
}
