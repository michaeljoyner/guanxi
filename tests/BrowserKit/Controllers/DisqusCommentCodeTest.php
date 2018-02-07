<?php


use App\Content\Article;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DisqusCommentCodeTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function the_disqus_snippet_is_included_on_an_article_page()
    {
        $article = factory(Article::class)->create(['published' => true, 'published_on' => Carbon::now()]);

        $this->visit('/articles/' . $article->slug)
            ->see('<div id="disqus_thread">');
    }

    /**
     * @test
     */
    public function the_disqus_snippet_contains_the_correct_config_variables()
    {
        $article = factory(Article::class)->create(['published' => true, 'published_on' => Carbon::now()]);

        $pageUrl = url('/articles/' . $article->slug);
        $page_id = $article->slug;

        $this->visit('/articles/' . $article->slug)
            ->see('this.page.url = "' . $pageUrl . '"')
            ->see('this.page.identifier = "' . $page_id . '"');
    }

    /**
     *@test
     */
    public function if_locale_is_zh_then_the_correct_disqus_identifier_is_used()
    {
        $article = factory(Article::class)->create(['published' => true, 'published_on' => Carbon::now()]);

        $pageUrl = url('/articles/' . $article->slug);
        $page_id = $article->slug;

        $this->visit('/articles/' . $article->slug)
            ->see('this.page.url = "' . $pageUrl . '"')
            ->see('this.page.identifier = "' . $page_id . '"');
    }

    /**
     *@test
     */
    public function the_disqus_snippet_is_not_included_in_admin_previews()
    {
        $article = factory(\App\Content\Article::class)->create(['published' => false]);

        $this->asLoggedInUser();

        $this->visit('/admin/preview/articles/' . $article->id)
            ->seePageIs('/admin/preview/articles/' . $article->id)
            ->dontSee('var disqus_config');
    }

    /**
     *@test
     */
    public function the_test_disqus_snippet_is_used_shown_in_non_production_environments()
    {
        $this->assertNotEquals('production', App::environment());
        $non_production_shortname = 'test-guanxi.disqus.com';

        $article = factory(Article::class)->create(['published' => true, 'published_on' => Carbon::now()]);

        $this->visit('/articles/' . $article->slug)
            ->see('<div id="disqus_thread">')
            ->see($non_production_shortname);

    }

}