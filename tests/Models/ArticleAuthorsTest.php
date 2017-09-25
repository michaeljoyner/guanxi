<?php


use App\Content\Article;
use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleAuthorsTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_article_has_a_profile_as_the_author()
    {
        $article = factory(Article::class)->create();

        $this->assertInstanceOf(Profile::class, $article->author);
    }

    /**
     *@test
     */
    public function an_article_can_have_its_author_set_to_a_different_profile()
    {
        $profile = factory(User::class)->create()->createProfile();
        $article = factory(Article::class)->create();
        $this->assertNotEquals($article->author->id, $profile->id);

        $article->setAuthor($profile);

        $article = $article->fresh();
        $this->assertEquals($article->author->id, $profile->id);
    }

    /**
     *@test
     */
    public function an_article_with_an_unpublished_author_does_not_link_the_attribute()
    {
        $profile = factory(Profile::class)->create(['published' => false]);
        $article = factory(Article::class)->create(['published' => true, 'published_on' => \Carbon\Carbon::now()]);
        $article->setAuthor($profile);

        $this->visit('/articles/' . $article->slug)
            ->see($article->title)
            ->dontSee('/bios/' . $profile->slug);
    }
}