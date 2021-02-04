<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_article_with_no_published_on_date_has_never_been_published()
    {
        $article = factory(Article::class)->create(['published_on' => null]);

        $this->assertFalse($article->hasBeenPublished());
    }

    /**
     *@test
     */
    public function an_article_can_be_published()
    {
        $article = factory(Article::class)->create(['published_on' => null]);

        $article->publish();

        $this->assertTrue($article->hasBeenPublished());
        $this->assertTrue($article->published);
    }

    /**
     *@test
     */
    public function a_published_article_can_be_retracted()
    {
        $article = factory(Article::class)->create(['published_on' => null]);
        $article->publish();

        $article->retract();

        $this->assertFalse($article->published);
    }

    /**
     * @test
     */
    public function an_article_that_is_yet_to_be_published_will_have_its_slug_updated()
    {
        $user = $this->asLoggedInUser();
        $article = $user->createArticle(['en' => "test title", 'zh' => "zh test title"], Article::TAIWAN);
        $this->assertEquals('test-title', $article->slug);

        $article->setTranslation('title', 'en', 'New Slug Dude');
        $article->save();
        $this->assertEquals('new-slug-dude', $article->slug, 'Should be updated slug');
    }

    /**
     *@test
     */
    public function an_article_that_has_been_published_wont_have_its_slug_updated()
    {
        $user = $this->asLoggedInUser();
        $article = $user->createArticle(['en' => "test title", 'zh' => "zh test title"], Article::TAIWAN);
        $article->publish();

        $this->assertEquals('test-title', $article->slug);

        $article->setTranslation('title', 'en', 'New Slug Dude');
        $article->save();
        $this->assertEquals('test-title', $article->slug, 'Should still be original slug');
    }

    /**
     *@test
     */
    public function the_body_of_an_article_can_be_set()
    {
        $user = $this->asLoggedInUser();
        $article = $user->createArticle(['en' => "test title", 'zh' => "zh test title"], Article::TAIWAN);
        $html = '<body><h1>Cool Title</h1><p>Sweet paragraph</p></body>';

        $article->setBody($html);
        $this->assertEquals($html, $article->body);

        $article->setBody('Zhongwen de shenti', 'zh');
        $this->assertEquals('Zhongwen de shenti', $article->getTranslation('body', 'zh'));
    }

    /**
     *@test
     */
    public function the_update_meta_method_updates_the_articles_titles_and_descriptions_for_en_and_zh()
    {
        $article = factory(Article::class)->create();
        $newData = [
            'title' => 'Updated Acme Title',
            'zh_title' => 'Xinde Jiade Mingzi',
            'description' => 'A descriptive thing',
            'zh_description' => 'I have forgotten how to say describe'
        ];

        $article->updateMeta($newData);

        $this->assertEquals('Updated Acme Title', $article->getTranslation('title', 'en'));
        $this->assertEquals('Xinde Jiade Mingzi', $article->getTranslation('title', 'zh'));
        $this->assertEquals('A descriptive thing', $article->getTranslation('description', 'en'));
        $this->assertEquals('I have forgotten how to say describe', $article->getTranslation('description', 'zh'));
    }

    /**
     *@test
     */
    public function an_article_can_be_marked_as_featured()
    {
        $article = factory(Article::class)->create();

        $article->feature();

        $this->assertTrue($article->is_featured);
    }

    /**
     *@test
     */
    public function an_article_can_be_unfeatured()
    {
        $article = factory(Article::class)->create(['is_featured' => true, 'published' => true]);

        $article->unfeature();

        $this->assertFalse($article->fresh()->is_featured);
    }

    /**
     *@test
     */
    public function only_one_article_is_featured_at_a_given_time()
    {
        $article = factory(Article::class)->create();
        $article2 = factory(Article::class)->create();
        $article->feature();
        $article2->feature();

        $this->assertCount(1, Article::where('is_featured', 1)->get());

    }
}