<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleAuthorizationTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_article_can_be_updated_by_its_owner()
    {
        $user = $this->asLoggedInContributor();
        $article = factory(Article::class)->create(['profile_id' => $user->profile->id]);
        $this->actingAs($article->author->user);

        $this->post('/admin/content/articles/' . $article->id, [
            'title' => 'TEST TITLE',
            'zh_title' => 'ZH TEST TITLE',
            'description' => 'TEST DESCRIPTION',
            'zh_description' => 'ZH TEST DESCRIPTION'
        ]);
        $this->assertResponseStatus(302);
        $this->seeInDatabase('articles', [
            'id' => $article->id,
            'title' => json_encode(['en' => 'TEST TITLE', 'zh' => 'ZH TEST TITLE'])
        ]);
    }

    /**
     *@test
     */
    public function an_article_can_be_updated_by_a_superadmin()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/content/articles/' . $article->id, [
            'title' => 'TEST TITLE',
            'zh_title' => 'ZH TEST TITLE',
            'description' => 'TEST DESCRIPTION',
            'zh_description' => 'ZH TEST DESCRIPTION'
        ]);
        $this->assertResponseStatus(302);
        $this->seeInDatabase('articles', [
            'id' => $article->id,
            'title' => json_encode(['en' => 'TEST TITLE', 'zh' => 'ZH TEST TITLE'])
        ]);
    }

    /**
     *@test
     */
    public function an_article_cannot_be_updated_by_a_different_contributor()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInContributor();

        $this->post('/admin/content/articles/' . $article->id, [
            'title' => 'TEST TITLE',
            'zh_title' => 'ZH TEST TITLE',
            'description' => 'TEST DESCRIPTION',
            'zh_description' => 'ZH TEST DESCRIPTION'
        ]);
        $this->assertResponseStatus(403);
        $this->notSeeInDatabase('articles', [
            'id' => $article->id,
            'title' => json_encode(['en' => 'TEST TITLE', 'zh' => 'ZH TEST TITLE'])
        ]);
    }

    /**
     *@test
     */
    public function an_articles_body_can_be_updated_by_its_owner()
    {
        $user = $this->asLoggedInContributor();
        $article = factory(Article::class)->create(['profile_id' => $user->profile->id]);
        $this->actingAs($article->author->user);

        $this->post('/admin/content/articles/' . $article->id . '/body/en', ['article_body' => 'TEST BODY']);
        $this->assertResponseStatus(200);

        $this->assertEquals($article->fresh()->body, 'TEST BODY');
    }

    /**
     *@test
     */
    public function an_articles_body_can_be_updated_by_a_superadmin()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/content/articles/' . $article->id . '/body/en', ['article_body' => 'TEST BODY']);
        $this->assertResponseStatus(200);

        $this->assertEquals($article->fresh()->body, 'TEST BODY');
    }

    /**
     *@test
     */
    public function an_articles_body_cannot_be_updated_by_a_different_contributor()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInContributor();

        $this->post('/admin/content/articles/' . $article->id . '/body/en', ['article_body' => 'TEST BODY']);
        $this->assertResponseStatus(403);

        $this->assertNotEquals($article->fresh()->body, 'TEST BODY');
    }

    /**
     *@test
     */
    public function an_articles_zh_body_can_be_updated_by_its_owner()
    {
        $user = $this->asLoggedInContributor();
        $article = factory(Article::class)->create(['profile_id' => $user->profile->id]);
        $this->actingAs($article->author->user);

        $this->post('/admin/content/articles/' . $article->id . '/body/zh', ['article_body' => 'ZH TEST BODY']);
        $this->assertResponseStatus(200);

        $this->assertEquals($article->fresh()->getTranslation('body', 'zh'), 'ZH TEST BODY');
    }

    /**
     *@test
     */
    public function an_article_can_be_published_by_its_owner()
    {
        $user = $this->asLoggedInContributor();
        $article = factory(Article::class)->create(['profile_id' => $user->profile->id]);
        $this->actingAs($article->author->user);

        $this->post('/admin/api/content/articles/' . $article->id . '/publish', ['publish' => true]);
        $this->assertResponseStatus(200);

        $this->assertEquals($article->fresh()->published, true);
    }

    /**
     *@test
     */
    public function an_article_can_be_published_by_a_superadmin()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/api/content/articles/' . $article->id . '/publish', ['publish' => true]);
        $this->assertResponseStatus(200);

        $this->assertEquals($article->fresh()->published, true);
    }

    /**
     *@test
     */
    public function an_article_cannot_be_published_by_a_different_contributor()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInContributor();

        $this->post('/admin/api/content/articles/' . $article->id . '/publish', ['publish' => true]);
        $this->assertResponseStatus(403);

        $this->assertNotEquals($article->fresh()->published, true);
    }

    /**
     *@test
     */
    public function an_article_can_be_deleted_by_its_owner()
    {
        $user = $this->asLoggedInContributor();
        $article = factory(Article::class)->create(['profile_id' => $user->profile->id]);
        $this->actingAs($article->author->user);

        $this->delete('/admin/content/articles/' . $article->id);
        $this->assertResponseStatus(302);

        $this->assertSoftDeleted($article);
    }

    /**
     *@test
     */
    public function an_article_can_be_deleted_by_a_super_admin()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInUser();

        $this->delete('/admin/content/articles/' . $article->id);
        $this->assertResponseStatus(302);

        $this->assertSoftDeleted($article);
    }

    /**
     *@test
     */
    public function an_article_cannot_be_deleted_by_a_different_contributor()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInContributor();

        $this->delete('/admin/content/articles/' . $article->id);
        $this->assertResponseStatus(403);

        $this->seeInDatabase('articles', ['id' => $article->id, 'deleted_at' => null]);
    }

    /**
     *@test
     */
    public function an_article_cannot_be_viewed_by_a_different_contributor()
    {
        $article = factory(Article::class)->create();
        $this->asLoggedInContributor();

        $this->get('/admin/content/articles/' . $article->id);
        $this->assertResponseStatus(403);
    }
}