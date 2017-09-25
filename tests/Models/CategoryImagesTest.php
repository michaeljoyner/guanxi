<?php


use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoryImagesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_category_has_a_model_image()
    {
        $category = factory(Category::class)->create();

        $category->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $category->getMedia());

        $category->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_category_has_a_default_image()
    {
        $category = factory(Category::class)->create();

        $this->assertEquals(Category::DEFAULT_IMAGE_SRC, $category->imageSrc());
    }
}