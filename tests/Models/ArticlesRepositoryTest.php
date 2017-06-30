<?php


use App\Content\Article;
use App\Content\ArticlesRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new ArticlesRepository;
    }

    /**
     * @test
     */
    public function the_featured_article_is_fetched()
    {
        $article = factory(Article::class)->create(['is_featured' => true, 'published' => true]);

        $this->assertEquals($article->id, $this->repo->getFeaturedArticle()->id);
    }

    /**
     * @test
     */
    public function the_featured_article_will_not_be_returned_if_it_is_not_published()
    {
        factory(Article::class)->create(['is_featured' => true, 'published' => false]);

        $this->assertNull($this->repo->getFeaturedArticle());
    }

    /**
     * @test
     */
    public function if_no_featured_article_exists_the_most_recently_published_is_returned_as_the_featured_article()
    {
        $article = factory(Article::class)->create([
            'published'    => true,
            'is_featured'  => false,
            'published_on' => '2017-01-1'
        ]);
        $article2 = factory(Article::class)->create([
            'published'    => true,
            'is_featured'  => false,
            'published_on' => '2016-12-1'
        ]);

        $featured = $this->repo->getFeaturedArticle();

        $this->assertEquals($article->id, $featured->id);
    }

    /**
     *@test
     */
    public function it_can_get_the_next_article_in_chronological_order_given_an_article()
    {
        $article = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2017-01-1'
        ]);
        $article2 = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2016-12-1'
        ]);
        $article3 = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2016-12-15'
        ]);

        $next = $this->repo->nextInLineAfter($article3);

        $this->assertEquals($article2->id, $next->id);

    }

    /**
     *@test
     */
    public function the_next_in_line_for_the_most_oldest_article_is_the_most_recent()
    {
        $article = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2017-01-1'
        ]);
        $article2 = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2016-12-1'
        ]);
        $article3 = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2016-12-15'
        ]);

        $next = $this->repo->nextInLineAfter($article2);

        $this->assertEquals($article->id, $next->id);
    }

    /**
     *@test
     */
    public function the_repository_will_not_return_an_unpublished_article_as_next_in_line()
    {
        $article = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2017-01-1'
        ]);
        $article2 = factory(Article::class)->create([
            'published'    => false,
            'published_on' => '2016-12-1'
        ]);
        $article3 = factory(Article::class)->create([
            'published'    => true,
            'published_on' => '2016-12-15'
        ]);

        $next = $this->repo->nextInLineAfter($article3);

        $this->assertEquals($article->id, $next->id);
    }

    /**
     *@test
     */
    public function it_fetches_articles_with_a_given_tag()
    {
        $article1 = factory(Article::class)->create();
        $article2 = factory(Article::class)->create();
        $article3 = factory(Article::class)->create();

        $tag = $article1->createAndAttachTag('fetch');
        $article2->createAndAttachTag('fetch');
        $article3->createAndAttachTag('dont fetch');

        $result = $this->repo->withTag($tag);

        $this->assertCount(2, $result);

        $this->assertTrue($result->contains($article1));
        $this->assertTrue($result->contains($article2));
        $this->assertFalse($result->contains($article3));
    }

    /**
     *@test
     */
    public function it_can_fetch_the_latest_public_articles()
    {
        $articles = [];
        foreach(range(0,9) as $index) {
            $articles[] = factory(Article::class)->create([
                'created_at' => \Carbon\Carbon::parse('-' . $index . ' days'),
                'published_on' => \Carbon\Carbon::parse('-' . $index . ' days'),
                'published' => $index !== 2
            ]);
        }

        $latest = $this->repo->latestPublished(4);

        $this->assertCount(4, $latest);
        $this->assertEquals($latest[0]->id, $articles[0]->id);
        $this->assertEquals($latest[1]->id, $articles[1]->id);
        $this->assertEquals($latest[2]->id, $articles[3]->id);
        $this->assertEquals($latest[3]->id, $articles[4]->id);
    }
}