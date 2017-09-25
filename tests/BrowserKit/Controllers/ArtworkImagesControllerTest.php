<?php


use App\Media\Artwork;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtworkImagesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function the_main_image_for_an_artwork_is_correctly_stored()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create();

        $response = $this->call('POST', '/admin/media/artworks/' . $artwork->id . '/mainimage', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $artwork->getMedia());

        $artwork->clearMediaCollection();
    }
}