<?php

namespace Tests\Feature\Articles;

use App\Content\Article;
use App\Content\ArticlesRepository;
use App\Content\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class ApiCategoryArticlesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_fetch_next_page_of_category_articles_via_api()
    {
        $this->withoutExceptionHandling();

        $categoryA = factory(Category::class)->create();
        $categoryB = factory(Category::class)->create();

        foreach (range(1, 50) as $index) {
            $articleA = factory(Article::class)->state('published')->create([
                'published_on' => Carbon::yesterday()->subDays($index)
            ]);
            $articleB = factory(Article::class)->state('published')->create([
                'published_on' => Carbon::yesterday()->subDays($index)
            ]);
            $articleA->setCategories([$categoryA->id]);
            $articleB->setCategories([$categoryB->id]);
        }

        $responseA = $this->getJson("/api/content/categories/{$categoryA->slug}");
        $responseA->assertSuccessful();

        $responseB = $this->getJson("/api/content/categories/{$categoryA->slug}?page=2");
        $responseB->assertSuccessful();

        $responseC = $this->getJson("/api/content/categories/{$categoryA->slug}?page=3");
        $responseC->assertSuccessful();

        $this->assertNotEquals($responseA->decodeResponseJson('content_html'), $responseB->decodeResponseJson('content_html'));

        
    }
}