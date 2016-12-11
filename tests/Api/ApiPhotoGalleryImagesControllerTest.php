<?php


use App\Media\Photo;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiPhotoGalleryImagesControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     * @test
     */
    public function the_images_of_a_public_gallery_can_be_fetched()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create();
        $img1 = $photo->addGalleryImage($this->prepareFileUpload('tests/testpic1.png', 'testpic1.png'));
        $img2 = $photo->addGalleryImage($this->prepareFileUpload('tests/testpic2.png', 'testpic2.png'));

        $this->get('/admin/api/media/photos/' . $photo->id . '/gallery/images')
            ->assertResponseOk()
            ->seeJson([
                'image_id'  => $img1->id,
                'src'       => $img1->getUrl(),
                'thumb_src' => $img1->getUrl('thumb')
            ])
            ->seeJson([
                'image_id'  => $img2->id,
                'src'       => $img2->getUrl(),
                'thumb_src' => $img2->getUrl('thumb')
            ]);

        $photo->clearMediaCollection();
        $photo->getGallery()->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_is_correctly_stored_in_the_gallery()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create();

        $response = $this->call('POST', '/admin/api/media/photos/' . $photo->id .'/gallery/images', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $photo->getGallery()->getMedia());

        $photo->getGallery()->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_photo_gallery_image_is_correctly_deleted()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create();
        $img1 = $photo->setMainImage($this->prepareFileUpload('tests/testpic1.png'));
        $img2 = $photo->addGalleryImage($this->prepareFileUpload('tests/testpic2.png'));

        $this->delete('/admin/api/media/photos/' . $photo->id . '/gallery/images/' . $img2->id)
            ->assertResponseOk()
            ->notSeeInDatabase('media', ['id' => $img2->id]);
    }
}