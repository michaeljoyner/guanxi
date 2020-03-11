<?php


use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoriesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_category_is_stored()
    {
        $this->asLoggedInUser();

        $this->post('/admin/content/categories', [
            'name'           => 'Taiwan',
            'zh_name'        => '誒恩',
            'description'    => 'Content about our beloved island',
            'zh_description' => '施粗'
        ])->assertResponseStatus(200)
            ->seeInDatabase('categories', [
                'name'        => json_encode(['en' => 'Taiwan', 'zh' => '誒恩']),
                'description' => json_encode(['en' => 'Content about our beloved island', 'zh' => '施粗'])
            ]);
    }

    /**
     * @test
     */
    public function a_category_is_updated()
    {
        $this->asLoggedInUser();
        $category = factory(Category::class)->create();

        $this->post('/admin/content/categories/' . $category->id, [
            'name'           => 'Taiwan',
            'zh_name'        => '誒恩',
            'description'    => 'Content about our beloved island',
            'zh_description' => '施粗'
        ])->assertResponseStatus(302)
            ->seeInDatabase('categories', [
                'id'          => $category->id,
                'name'        => json_encode(['en' => 'Taiwan', 'zh' => '誒恩']),
                'description' => json_encode(['en' => 'Content about our beloved island', 'zh' => '施粗'])
            ]);
    }

    /**
     *@test
     */
    public function a_category_is_properly_deleted()
    {
        $this->asLoggedInUser();
        $category = factory(Category::class)->create();

        $this->delete('/admin/content/categories/' . $category->id)
            ->assertResponseStatus(302)
            ->assertSoftDeleted($category);
    }
}