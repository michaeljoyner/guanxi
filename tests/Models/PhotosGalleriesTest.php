<?php


use App\Media\Gallery;
use App\Media\Photo;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhotosGalleriesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function a_photo_has_a_gallery()
    {
        $photo_gallery = factory(Photo::class)->create();

        $this->assertInstanceOf(Gallery::class, $photo_gallery->getGallery());
    }

    /**
     *@test
     */
    public function an_image_can_be_added_to_the_gallery_via_the_photo()
    {
        $photo = factory(Photo::class)->create();

        $photo->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $photo->getGallery()->getMedia());

        $photo->getGallery()->clearMediaCollection();
    }

    /**
     *@test
     */
    public function deleting_a_photo_will_delete_its_gallery()
    {
        $photo = factory(Photo::class)->create();
        $photo->addGalleryImage($this->prepareFileUpload('tests/testpic1.png', 'tobedeleted.png'));
        $imagePath = $photo->getGallery()->getMedia()->first()->getPath();

        $photo->delete();

        $this->notSeeInDatabase('galleries', [
            'galleryable_id' => $photo->id,
            'galleryable_type' => Photo::class
        ]);

        $this->assertFalse(file_exists($imagePath));
    }

    /**
     *@test
     */
    public function gallery_images_by_default_include_the_photo_main_image_as_the_first_in_the_collection()
    {
        $photo = factory(Photo::class)->create();
        $photo->setMainImage($this->prepareFileUpload('tests/testpic1.png', 'testpic1.png'));
        $photo->addGalleryImage($this->prepareFileUpload('tests/testpic2.png', 'testpic2.png'));

        $images = $photo->galleryImages();

        $this->assertCount(2, $images);
        $this->assertContains('testpic1', $images->first()->getPath());
        $this->assertContains('testpic2', $images->last()->getPath());
    }
}