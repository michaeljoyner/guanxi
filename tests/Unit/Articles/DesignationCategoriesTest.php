<?php


namespace Tests\Unit\Articles;


use App\Content\Article;
use App\Content\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DesignationCategoriesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_query_categories_for_a_given_designation()
    {
        $catA = factory(Category::class)->create();
        $catB = factory(Category::class)->create();
        $catC = factory(Category::class)->create();

        $artWorld = factory(Article::class)->states(['world', 'published'])->create();
        $artTaiwan = factory(Article::class)->states(['taiwan', 'published'])->create();

        $artWorld->setCategories([$catA->id, $catC->id]);
        $artTaiwan->setCategories([$catB->id, $catC->id]);

        $for_world = Category::forWorld()->get();
        $for_taiwan = Category::forTaiwan()->get();
        $for_all = Category::hasPublishedArticles()->get();

        $this->assertTrue($for_world->contains($catA));
        $this->assertFalse($for_world->contains($catB));
        $this->assertTrue($for_world->contains($catC));

        $this->assertFalse($for_taiwan->contains($catA));
        $this->assertTrue($for_taiwan->contains($catB));
        $this->assertTrue($for_taiwan->contains($catC));

        $this->assertTrue($for_all->contains($catA));
        $this->assertTrue($for_all->contains($catB));
        $this->assertTrue($for_all->contains($catC));
    }
}