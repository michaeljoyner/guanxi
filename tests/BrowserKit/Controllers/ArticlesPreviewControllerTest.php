<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesPreviewControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_unpublished_article_can_be_previewed_by_an_admin_user()
    {
        $article = factory(\App\Content\Article::class)->create(['published' => false]);

        $this->asLoggedInUser();

        $this->visit('/admin/preview/articles/' . $article->id)
            ->seePageIs('/admin/preview/articles/' . $article->id)
            ->see($article->title);
    }

    /**
     *@test
     */
    public function a_non_logged_in_user_cannot_preview_an_article()
    {
        $article = factory(\App\Content\Article::class)->create(['published' => false]);


        $this->visit('/admin/preview/articles/' . $article->id)
            ->seePageIs('/admin/login');
    }
}