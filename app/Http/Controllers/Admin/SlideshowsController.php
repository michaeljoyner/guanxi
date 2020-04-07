<?php

namespace App\Http\Controllers\Admin;

use App\Content\Article;
use App\Content\Slideshow;
use App\Http\Controllers\Controller;
use App\Http\FlashMessaging\Flasher;
use Illuminate\Http\Request;

class SlideshowsController extends Controller
{

    public function edit(Slideshow $slideshow)
    {
        return view('admin.slideshows.edit', ['slideshow' => $slideshow]);
    }

    public function store(Article $article)
    {
        request()->validate(['title' => ['required']]);

        $slideshow = $article->addSlideshow(request('title'));

        return ['redirect' => "/admin/slideshows/{$slideshow->id}/edit"];
    }

    public function delete(Slideshow $slideshow, Flasher $flasher)
    {
        $slideshow->delete();

        $flasher->success('Deleted', 'The slideshow and its slides have been erased. Forever.');

        return redirect("/admin/content/articles/{$slideshow->article_id}");
    }
}
