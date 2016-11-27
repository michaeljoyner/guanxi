<?php


use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_posted_image_is_attached_to_the_category()
    {
        $category = factory(Category::class)->create();
        $this->asLoggedInUser();

        $response = $this->call('POST', '/admin/content/categories/' . $category->id . '/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertTrue($category->hasModelImageSet());

        $category->clearMediaCollection();
    }
}