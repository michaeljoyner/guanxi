<?php


use App\Content\Article;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiArticleFeaturedImageControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_existing_image_is_correctly_set_as_the_featured_image()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();
        $image = $article->addImage($this->prepareFileUpload('tests/testpic1.png', 'featured.png'));

        $this->patch('/admin/api/content/articles/' . $article->id . '/images/featured', ['image_id' => $image->id])
            ->assertResponseOk();

        $article = $article->fresh();

        $this->assertEquals($image->id, $article->featuredImage()->id);

        $article->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_new_image_can_be_directly_uploaded_and_stored_as_the_articles_featured_image()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();

        $response = $this->call('POST', '/admin/api/content/articles/' . $article->id . '/images/featured', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png', 'featured.png')
        ]);
        $this->assertEquals(200, $response->status());
        $this->assertArrayHasKey('url', json_decode($response->getContent(), true));
        $this->assertArrayHasKey('is_feature', json_decode($response->getContent(), true));
        $this->assertArrayHasKey('id', json_decode($response->getContent(), true));
        $this->assertArrayHasKey('thumb', json_decode($response->getContent(), true));

        $article = $article->fresh();
        $this->assertStringContainsString('featured.png', $article->featuredImage()->getPath());
        $article->clearMediaCollection();
    }

    /**
     *@test
     */
    public function the_index_of_articles_images_is_correctly_given()
    {
        $this->asLoggedInUser();
        $article = factory(Article::class)->create();
        $image1 = $article->addImage($this->prepareFileUpload('tests/testpic1.png'));
        $image2 = $article->addImage($this->prepareFileUpload('tests/testpic2.png'));

        $this->get('/admin/api/content/articles/' . $article->id . '/images/featured')
            ->assertResponseOk()
            ->seeJson([
                'url' => $image1->getUrl(),
                'thumb' => $image1->getUrl('thumb'),
                'id' => $image1->id,
                'is_feature' => false
            ])
            ->seeJson([
                'url' => $image2->getUrl(),
                'thumb' => $image2->getUrl('thumb'),
                'id' => $image2->id,
                'is_feature' => false
            ]);

        $this->assertCount(2, json_decode($this->response->getContent(), true));
        $article->clearMediaCollection();
    }
}