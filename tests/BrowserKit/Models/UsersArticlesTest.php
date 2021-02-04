<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersArticlesTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_user_can_post_an_article_with_just_a_title_in_english_or_chinese()
    {
        $user = $this->asLoggedInUser();

        $articleWithEnglishTitle = $user->createArticle(['en' => 'The Queens English', 'zh' => ''], \App\Content\Article::TAIWAN);
        $this->assertInstanceOf(\App\Content\Article::class, $articleWithEnglishTitle);
        $this->assertEquals('The Queens English', $articleWithEnglishTitle->getTranslation('title', 'en'));

        $articleWithChineseTitle = $user->createArticle(['en' => '', 'zh' => 'The Emperors Decree'], \App\Content\Article::TAIWAN);
        $this->assertInstanceOf(\App\Content\Article::class, $articleWithChineseTitle);
        $this->assertEquals('The Emperors Decree', $articleWithChineseTitle->getTranslation('title', 'zh'));
    }

    /**
     *@test
     */
    public function a_article_belongs_to_a_profile_as_opposed_to_a_user()
    {
        $user = $this->asLoggedInUser();
        $article= $user->createArticle(['en' => "test title", 'zh' => "zh test title"], \App\Content\Article::TAIWAN);

        $this->assertInstanceOf(\App\People\Profile::class, $article->author);
        $this->assertEquals($article->author->id, $user->profile->id);
    }
}