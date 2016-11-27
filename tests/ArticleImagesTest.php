<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleImagesTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_can_be_attached_to_an_article()
    {
        $article = factory(\App\Content\Article::class)->create();

        $article->addImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $article->getMedia());

        $article->clearMediaCollection();
    }
}