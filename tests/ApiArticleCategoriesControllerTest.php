<?php


use App\Content\Article;
use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiArticleCategoriesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_articles_categories_are_properly_synced()
    {
        $article = factory(Article::class)->create();
        $categories = factory(Category::class, 2)->create();

        $this->asLoggedInUser();

        $this->post('/admin/api/content/articles/' . $article->id . '/categories', [
            'categories' => $categories->pluck('id')->toArray()
        ])->assertResponseOk()->seeJson(['article_categories' => $categories->pluck('id')->toArray()]);

        $this->assertCount(2, $article->categories);
    }
}