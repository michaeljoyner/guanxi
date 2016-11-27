<?php


use App\Content\Article;
use App\Content\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleTagsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_tag_can_be_attached_to_an_article()
    {
        $article = factory(Article::class)->create();
        $tag = factory(Tag::class)->create();

        $article->addTag($tag);

        $this->assertCount(1, $article->tags);
        $this->assertEquals($tag->id, $article->tags->first()->id);
    }

    /**
     *@test
     */
    public function a_tag_can_be_detached_from_an_article()
    {
        $article = factory(Article::class)->create();
        $tag = factory(Tag::class)->create();
        $article->addTag($tag);
        $article = $article->fresh();

        $article->removeTag($tag);

        $this->assertCount(0, $article->tags);
    }

    /**
     *@test
     */
    public function an_array_of_tags_can_be_synced_with_an_article()
    {
        $tags = factory(Tag::class, 5)->create();
        $article = factory(Article::class)->create();

        $article->syncTags($tags);

        $this->assertCount(5, $article->tags);
        $tags->each(function($tag) use ($article) {
            $this->assertTrue($article->tags->contains($tag));
        });
    }

    /**
     *@test
     */
    public function tags_can_be_synced_by_passing_array_of_tag_ids()
    {
        $tags = factory(Tag::class, 5)->create()->pluck('id')->toArray();
        $article = factory(Article::class)->create();

        $article->syncTags($tags);
        $article = $article->fresh();

        $this->assertCount(5, $article->tags);
        $collectedTags = collect($tags);
        $article->tags->each(function($tag) use ($collectedTags) {
            $this->assertTrue($collectedTags->contains($tag->id));
        });
    }
}