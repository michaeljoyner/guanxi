<?php


use App\Content\Article;
use App\Content\Tag;
use App\Content\TagRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagsRepositoryTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    protected $repo;

    protected function setUp()
    {
        parent::setUp();
        $this->repo = new TagRepository();
    }

    /**
     *@test
     */
    public function it_can_fetch_all_unused_tags()
    {
        $unusedTags = factory(Tag::class, 6)->create();
        $article = factory(Article::class)->create();
        $article2 = factory(Article::class)->create();

        $article->syncTags(factory(Tag::class, 4)->create());
        $article2->syncTags(factory(Tag::class, 4)->create());

        $this->assertCount(14, Tag::all());
        $this->assertCount(6, $this->repo->unusedTags());

        $this->repo->unusedTags()->each(function($tag) use ($unusedTags) {
            $this->assertTrue(in_array($tag->id, $unusedTags->pluck('id')->toArray()));
        });
    }
    
    /**
     *@test
     */
    public function it_can_get_a_sorted_list_of_of_tags_by_popularity()
    {
        $mooz = factory(Tag::class)->create();
        $lennon = factory(Tag::class)->create();
        $gallager = factory(Tag::class)->create();
        
        $articles = factory(Article::class, 5)->create();
        
        $articles->each(function($article) use ($mooz) {
            $article->addTag($mooz);
        });

        $articles->take(3)->each(function($article) use ($gallager) {
            $article->addTag($gallager);
        });

        $articles->take(1)->each(function($article) use ($lennon) {
            $article->addTag($lennon);
        });


        $byPopularity = $this->repo->allByPopularity();

        $this->assertCount(3, $byPopularity);
        $this->assertEquals($byPopularity[0]->id, $mooz->id);
        $this->assertEquals($byPopularity[1]->id, $gallager->id);
        $this->assertEquals($byPopularity[2]->id, $lennon->id);
        
    }
}