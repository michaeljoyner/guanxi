<?php


use App\Content\Article;
use App\Content\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleTagsTest extends BrowserKitTestCase
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

    /**
     *@test
     */
    public function a_tag_can_be_created_and_then_attached_to_an_article()
    {
        $article = factory(Article::class)->create();

        $article->createAndAttachTag('zonda');
        $article = $article->fresh();
        $this->assertCount(1, $article->tags);
        $this->assertEquals('zonda', $article->tags->first()->name);
    }

    /**
     *@test
     */
    public function create_and_attach_tag_will_not_duplicate_a_tag_but_rather_just_attach_to_article()
    {
        $tag = factory(Tag::class)->create(['name' => 'zonda']);
        $article = factory(Article::class)->create();
        $article->addTag($tag);

        $article->createAndAttachTag('zonda');
        $this->assertCount(1, $article->tags, 'Should only have one tag');
        $this->assertEquals('zonda', $article->tags->first()->name);
        $this->assertCount(1, Tag::where('name', 'zonda')->get());
    }

    /**
     *@test
     */
    public function deleting_a_tag_removes_any_records_of_it_from_the_article_tag_pivot()
    {
        $article1 = factory(Article::class)->create();
        $article2 = factory(Article::class)->create();
        $tag = factory(Tag::class)->create();

        $article1->addTag($tag);
        $article2->addTag($tag);

        $tag->delete();
        $this->notSeeInDatabase('tags', ['id' => $tag->id]);
        $this->notSeeInDatabase('article_tag', ['tag_id', $tag->id]);

        $this->assertCount(0, $article1->tags);
        $this->assertCount(0, $article2->tags);
    }
}