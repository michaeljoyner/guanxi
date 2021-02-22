<?php


namespace Tests\Feature\Articles;


use App\Content\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticlesSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function search_articles_by_title()
    {
        $this->withoutExceptionHandling();

        $articleA = factory(Article::class)->create([
            'title' => [
                'en' => "find me",
                'zh' => "zh find me"
            ]

        ]);
        $articleB = factory(Article::class)->create([
            'title' => [
                'en' => "will be found",
                'zh' => "look and find"
            ]

        ]);
        $articleC = factory(Article::class)->create([
            'title' => [
                'en' => "never see",
                'zh' => "the light of day"
            ]
        ]);

        $response = $this->asSuperAdmin()->getJson("/admin/content/search/articles?q=find");
        $response->assertSuccessful();

        $found = $response->json();

        $this->assertCount(2, $found);
        $this->assertTrue(collect($found)->contains(fn ($a) => $a['id'] === $articleA->id));
        $this->assertTrue(collect($found)->contains(fn ($a) => $a['id'] === $articleB->id));
    }
}