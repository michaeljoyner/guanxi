<?php


use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilePublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_profile_is_correctly_marked_as_published()
    {
        $this->asLoggedInUser();
        $profile = factory(Profile::class)->create(['published' => false]);

        $this->post('/admin/profiles/' . $profile->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('profiles', ['id' => $profile->id, 'published' => 1]);
    }

    /**
     *@test
     */
    public function a_published_profile_is_correctly_retracted()
    {
        $this->asLoggedInUser();
        $profile = factory(Profile::class)->create(['published' => true]);

        $this->post('/admin/profiles/' . $profile->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('profiles', ['id' => $profile->id, 'published' => 0]);
    }
}