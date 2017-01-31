<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FeaturedArticleControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_article_is_correctly_marked_as_featured()
    {
        $article = factory(Article::class)->create(['is_featured' => false, 'published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/content/articles/' . $article->id . '/feature', ['feature' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('articles', [
                'id' => $article->id,
                'is_featured' => 1
            ]);
    }

    /**
     *@test
     */
    public function an_article_is_correctly_unfeatured()
    {
        $article = factory(Article::class)->create(['is_featured' => true, 'published' => true]);

        $this->asLoggedInUser();
        $this->post('/admin/content/articles/' . $article->id . '/feature', ['feature' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('articles', [
                'id' => $article->id,
                'is_featured' => 0
            ]);
    }

    /**
     *@test
     */
    public function the_current_featured_article_is_correctly_shown()
    {
        $article = factory(Article::class)->create(['is_featured' => true, 'published' => true]);

        $this->asLoggedInUser();
        $this->get('/admin/content/articles/featured')
            ->assertResponseOk()
            ->seeJson([
                'id' => $article->id,
                'title' => $article->title
            ]);
    }
}