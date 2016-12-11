<?php

use App\Media\Photo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhotoMainImageControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_image_can_be_uploaded_and_is_correctly_stored()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create();

        $response = $this->call('POST', '/admin/media/photos/' . $photo->id . '/mainimage', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $photo->getMedia());
        $photo->clearMediaCollection();
    }
}
