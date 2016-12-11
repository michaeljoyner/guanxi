<?php


use App\Content\Article;
use App\Content\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleTagsControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_articles_tags_are_successfully_fetched()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();
        $tags = factory(Tag::class, 5)->create();
        $article->syncTags($tags);

        $this->get('/admin/content/articles/' . $article->id . '/tags')
            ->assertResponseOk();

        $tags->each(function ($tag) {
            $this->seeJson([
                'id'   => $tag->id,
                'name' => $tag->name
            ]);
        });
        $this->assertCount(5, json_decode($this->response->getContent(), true));
    }

    /**
     * @test
     */
    public function an_article_with_no_tags_will_result_in_empty_array()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();

        $this->get('/admin/content/articles/' . $article->id . '/tags')
            ->assertResponseOk()
            ->assertCount(0, json_decode($this->response->getContent(), true));
    }

    /**
     *@test
     */
    public function a_new_tag_can_be_posted_directly_to_an_article()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();

        $this->post('/admin/content/articles/' . $article->id . '/tags', [
            'name' => 'zonda'
        ])->assertResponseOk();

        $article = $article->fresh();
        $this->assertCount(1, $article->tags);
        $this->assertEquals('zonda', $article->tags->first()->name);
    }

    /**
     *@test
     */
    public function an_array_of_tags_can_be_correctly_synced_to_article_by_put_request()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();
        $originalTags = factory(Tag::class, 3)->create();
        $tags = factory(Tag::class, 5)->create();

        $this->put('/admin/content/articles/' . $article->id . '/tags', [
            'tag_ids' => $tags->pluck('id')->toArray()
        ])->assertResponseOk();

        $this->assertCount(5, $article->tags);

        $article->tags->each(function($tag) {
            $this->seeJson(['id' => $tag->id, 'name' => $tag->name]);
        });
        $this->assertCount(5, json_decode($this->response->getContent(), true), 'original tags should not be part of payload');
    }
}