<?php


use App\Content\Category;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CategoriesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     * @test
     */
    public function categories_are_a_thang()
    {
        $category = factory(Category::class)->create();

        $this->assertInstanceOf(Category::class, $category);
    }

    /**
     * @test
     */
    public function a_category_can_be_created_with_translated_data()
    {
        $data = [
            'name'           => 'Taiwan',
            'zh_name'        => '誒恩',
            'description'    => 'Content about our beloved island',
            'zh_description' => '施粗',
            'writeup'        => 'More content about this god forsaken place',
            'zh_writeup'     => '施唷'
        ];

        $category = Category::createWithTranslations($data);

        $this->assertEquals('Taiwan', $category->getTranslation('name', 'en'));
        $this->assertEquals('誒恩', $category->getTranslation('name', 'zh'));
        $this->assertEquals('Content about our beloved island', $category->getTranslation('description', 'en'));
        $this->assertEquals('施粗', $category->getTranslation('description', 'zh'));
        $this->assertEquals('More content about this god forsaken place', $category->getTranslation('writeup', 'en'));
        $this->assertEquals('施唷', $category->getTranslation('writeup', 'zh'));
    }

    /**
     *@test
     */
    public function a_category_can_be_updated_with_translations()
    {
        $category = factory(Category::class)->create();
        $data = [
            'name'           => 'Taiwan',
            'zh_name'        => '誒恩',
            'description'    => 'Content about our beloved island',
            'zh_description' => '施粗',
            'writeup'        => 'More content about this god forsaken place',
            'zh_writeup'     => '施唷'
        ];

        $category->updateWithTranslations($data);

        $this->assertEquals('Taiwan', $category->getTranslation('name', 'en'));
        $this->assertEquals('誒恩', $category->getTranslation('name', 'zh'));
        $this->assertEquals('Content about our beloved island', $category->getTranslation('description', 'en'));
        $this->assertEquals('施粗', $category->getTranslation('description', 'zh'));
        $this->assertEquals('More content about this god forsaken place', $category->getTranslation('writeup', 'en'));
        $this->assertEquals('施唷', $category->getTranslation('writeup', 'zh'));
    }


}