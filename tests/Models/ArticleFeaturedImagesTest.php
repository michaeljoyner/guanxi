<?php

use App\Content\Article;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ArticleFeaturedImagesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_belonging_to_the_article_can_be_set_as_the_featured_image()
    {
        $article = factory(Article::class)->create();
        $image = $article->addImage($this->prepareFileUpload('tests/testpic1.png', 'featured.png'));

        $article->setFeaturedImage($image);

        $article = $article->fresh();

        $this->assertEquals($image->id, $article->featuredImage()->id);
        $this->assertContains('featured.png', $article->featuredImage()->getPath());

        $article->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_not_belonging_to_that_post_cannot_be_set_as_a_featured_image()
    {
        $article = factory(Article::class)->create();
        $article2 = factory(Article::class)->create();
        $image = $article2->addImage($this->prepareFileUpload('tests/testpic1.png', 'featured.png'));

        $this->expectException(\Exception::class);
        $article->setFeaturedImage($image);

        $this->assertEquals($image->id, $article->featuredImage()->id);
        $this->assertContains('featured.png', $article->featuredImage()->getPath());

        $article->clearMediaCollection();
    }

    /**
     *@test
     */
    public function there_is_only_ever_at_most_one_featured_image()
    {
        $article = factory(Article::class)->create();
        $image = $article->addImage($this->prepareFileUpload('tests/testpic1.png', 'featured.png'));
        $image2 = $article->addImage($this->prepareFileUpload('tests/testpic2.png', 'newfeatured.png'));

        $article->setFeaturedImage($image);
        $article = $article->fresh();
        $article->setFeaturedImage($image2);
        $article = $article->fresh();

        $this->assertCount(1, $article->getMedia()->filter(function($image) { return $image->getCustomProperty('is_feature'); }));
    }
}
