<?php


use App\Content\Article;
use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleAuthorControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_articles_author_is_correctly_updated()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();
        $profile = factory(Profile::class)->create();

        $this->post('/admin/content/articles/' . $article->id . '/author/' . $profile->id)
            ->assertResponseOk()
            ->seeInDatabase('articles', [
                'id' => $article->id,
                'profile_id' => $profile->id
            ]);
    }
}