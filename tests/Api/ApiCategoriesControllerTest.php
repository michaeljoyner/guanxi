<?php


use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiCategoriesControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_index_of_categories_is_returned()
    {
        $this->asLoggedInUser();
        $categories = factory(Category::class, 3)->create();

        $this->get('/admin/api/content/categories')
            ->assertResponseOk();

        $categories->each(function($category) {
            $this->seeJson([
                'id' => $category->id,
                'name' => $category->getTranslation('name', 'en')
            ]);
        });
    }
}