<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_article_is_created_for_the_current_user()
    {
        $user = $this->asLoggedInUser();

        $this->post('/admin/content/articles/', [
            'title' => 'Acme Article Title',
            'lang' => 'en',
            'designation' => Article::TAIWAN
        ]);

        $this->assertCount(1, $user->profile->articles);
        $this->assertEquals('Acme Article Title', $user->profile->articles->first()->title);
    }

    /**
     *@test
     */
    public function the_article_is_updated_correctly()
    {
        $this->asLoggedInUser();

        $article = factory(Article::class)->create();

        $this->post('/admin/content/articles/' . $article->id, [
            'title' => 'Updated Acme Title',
            'zh_title' => 'Xinde Jiade Mingzi',
            'description' => 'A descriptive thing',
            'zh_description' => 'I have forgotten how to say describe'
        ]);

        $this->seeInDatabase('articles', [
            'id' => $article->id,
            'title' => json_encode(['en' => 'Updated Acme Title', 'zh' => 'Xinde Jiade Mingzi']),
            'description' => json_encode(['en' => 'A descriptive thing', 'zh' => 'I have forgotten how to say describe']),
        ]);
    }

    /**
     *@test
     */
    public function an_article_is_properly_deleted()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();

        $this->delete('/admin/content/articles/' . $article->id)
            ->assertResponseStatus(302);

        $this->assertSoftDeleted($article);
    }
}