<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArticleImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_posted_image_is_attached_to_the_article()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();

        $response = $this->call('POST', '/admin/content/articles/' . $article->id . '/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $article->getMedia());

        $article->clearMediaCollection();
    }
}