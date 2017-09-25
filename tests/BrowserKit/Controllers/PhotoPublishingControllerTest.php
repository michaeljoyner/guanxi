<?php

use App\Media\Photo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhotoPublishingControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_photo_is_correctly_published()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create(['published' => false]);

        $this->post('/admin/media/photos/' . $photo->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('photos', ['id' => $photo->id, 'published' => 1]);
    }

    /**
     *@test
     */
    public function a_photo_is_correctly_retracted()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create(['published' => true]);

        $this->post('/admin/media/photos/' . $photo->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('photos', ['id' => $photo->id, 'published' => 0]);
    }
}
