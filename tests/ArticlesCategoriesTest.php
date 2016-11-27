<?php


use App\Content\Article;
use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticlesCategoriesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function categories_can_be_set_on_the_article()
    {
        $article = factory(Article::class)->create();
        $categories = factory(Category::class, 2)->create();

        $article->setCategories($categories->pluck('id')->toArray());

        $this->assertCount(2, $article->categories);
    }

    /**
     *@test
     */
    public function a_single_category_id_may_be_passed_to_set_categories_method()
    {
        $article = factory(Article::class)->create();
        $category = factory(Category::class)->create();

        $article->setCategories($category->id);

        $this->assertCount(1, $article->categories);
    }

    /**
     *@test
     */
    public function a_category_has_a_relationship_with_its_articles()
    {
        $article1 = factory(Article::class)->create();
        $article2 = factory(Article::class)->create();
        $category = factory(Category::class)->create();

        $article1->setCategories($category->id);
        $article2->setCategories($category->id);

        $this->assertCount(2, $category->articles);
    }
}