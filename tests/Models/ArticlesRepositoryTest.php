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
}