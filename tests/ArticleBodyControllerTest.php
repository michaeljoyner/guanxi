<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleBodyControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function the_articles_english_body_is_saved_and_returned()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create(['body' => ['en' => '', 'zh' => 'yixie zhongwen danzi']]);

        $this->post('/admin/content/articles/' . $article->id . '/body/en', [
            'article_body' => 'This is the articles body'
        ])
            ->assertResponseOk()
            ->seeJson([
                'body' => 'This is the articles body'
            ]);

        $this->assertEquals('yixie zhongwen danzi', $article->getTranslation('body', 'zh'));
    }

    /**
     *@test
     */
    public function the_articles_chinese_body_is_updated_and_returned()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create(['body' => ['en' => 'An english body', 'zh' => '']]);

        $this->post('/admin/content/articles/' . $article->id . '/body/zh', [
            'article_body' => 'Yixie zhongwen danzi'
        ])
            ->assertResponseOk()
            ->seeJson([
                'body' => 'Yixie zhongwen danzi'
            ]);

        $this->assertEquals('An english body', $article->getTranslation('body', 'en'));
    }


}