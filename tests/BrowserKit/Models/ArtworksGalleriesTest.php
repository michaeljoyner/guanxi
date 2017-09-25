<?php


use App\Media\Artwork;
use App\Media\Gallery;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtworksGalleriesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_artwork_has_a_gallery()
    {
        $artwork = factory(Artwork::class)->create();

        $this->assertInstanceOf(Gallery::class, $artwork->getGallery());
    }

    /**
     *@test
     */
    public function an_image_can_be_added_to_the_artworks_gallery()
    {
        $artwork = factory(Artwork::class)->create();

        $artwork->addGalleryImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $artwork->getGallery()->getMedia());

        $artwork->getGallery()->clearMediaCollection();
    }

    /**
     *@test
     */
    public function deleting_an_artwork_also_deletes_its_gallery()
    {
        $artwork = factory(Artwork::class)->create();
        $artwork->addGalleryImage($this->prepareFileUpload('tests/testpic1.png', 'tobedeleted.png'));
        $imagePath = $artwork->getGallery()->getMedia()->first()->getPath();
        $this->assertTrue(file_exists($imagePath));

        $artwork->delete();

        $this->notSeeInDatabase('galleries', [
            'galleryable_id' => $artwork->id,
            'galleryable_type' => Artwork::class
        ]);

        $this->assertFalse(file_exists($imagePath));
    }
}