<?php

namespace Test\Unit\Articles;

use App\Content\Article;
use App\Content\Slideshow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleSlideshowTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function add_slideshow_to_article()
    {
        $article = factory(Article::class)->create();

        $slideshow = $article->addSlideshow('test slideshow');

        $this->assertInstanceOf(Slideshow::class, $slideshow);
        $this->assertEquals($article->id, $slideshow->article_id);
        $this->assertEquals('test slideshow', $slideshow->title);
    }
}