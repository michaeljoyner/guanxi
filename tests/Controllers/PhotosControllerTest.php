<?php

use App\Media\Photo;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PhotosControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     * @test
     */
    public function a_photo_is_correctly_stored_with_just_a_title()
    {
        $user = $this->asLoggedInUser();

        $this->post('/admin/media/photos', [
            'title' => 'Acme photo'
        ])->assertResponseStatus(302)
            ->seeInDatabase('photos', [
                'title'       => json_encode(['en' => 'Acme photo', 'zh' => '']),
                'description' => json_encode(['en' => '', 'zh' => '']),
                'profile_id'  => $user->profile->id,
            ]);
    }

    /**
     *@test
     */
    public function a_photos_title_and_description_are_properly_updated()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create();

        $this->post('/admin/media/photos/' . $photo->id, [
            'title' => 'Acme title',
            'zh_title' => 'Chinese acme title',
            'description' => 'A florid description',
            'zh_description' => ''
        ])->assertResponseStatus(302)
            ->seeInDatabase('photos', [
                'id' => $photo->id,
                'title' => json_encode(['en' => 'Acme title', 'zh' => 'Chinese acme title']),
                'description' => json_encode(['en' => 'A florid description', 'zh' => ''])
            ]);
    }

    /**
     *@test
     */
    public function a_photo_is_deleted_as_requested()
    {
        $this->asLoggedInUser();
        $photo = factory(Photo::class)->create();

        $this->delete('/admin/media/photos/' . $photo->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('photos', ['id' => $photo->id]);
    }
}
