<?php


use App\Media\Artwork;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiArtworkGalleryImagesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_artworks_gallery_images_can_be_fetched_without_the_main_image_included()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create();
        $img1 = $artwork->addGalleryImage($this->prepareFileUpload('tests/testpic1.png', 'testpic1.png'));
        $img2 = $artwork->addGalleryImage($this->prepareFileUpload('tests/testpic2.png', 'testpic2.png'));

        $this->get('/admin/api/media/artworks/' . $artwork->id . '/gallery/images')
            ->assertResponseOk()
            ->seeJson([
                'image_id' => $img1->id,
                'src' => $img1->getUrl(),
                'thumb_src' => $img1->getUrl('thumb')
            ])
            ->seeJson([
                'image_id' => $img2->id,
                'src' => $img2->getUrl(),
                'thumb_src' => $img2->getUrl('thumb')
            ]);

        $artwork->getGallery()->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_stored_in_the_artworks_gallery()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create();

        $response = $this->call('POST', '/admin/api/media/artworks/' . $artwork->id . '/gallery/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $artwork->getGallery()->getMedia());
        $artwork->getGallery()->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_is_correctly_deleted_from_the_artworks_gallery()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create();
        $image = $artwork->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->delete('/admin/api/media/artworks/' . $artwork->id . '/gallery/images/' . $image->id)
            ->assertResponseOk();

        $this->notSeeInDatabase('media', ['id' => $image->id]);
        $this->assertCount(0, $artwork->getGallery()->getMedia());
    }
}