<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiArticlePublishControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function the_unpublished_article_is_published()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();

        $this->post('/admin/api/content/articles/' . $article->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true]);

        $article = Article::find($article->id);
        $this->assertTrue($article->published);
    }

    /**
     *@test
     */
    public function the_published_article_is_retracted()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();
        $article->publish();

        $this->post('/admin/api/content/articles/' . $article->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false]);

        $article = Article::find($article->id);
        $this->assertFalse($article->published);
    }
}