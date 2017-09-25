<?php


use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_profile_can_be_deleted()
    {
        $profile = factory(Profile::class)->create(['user_id' => null]);
        $this->asLoggedInUser();

        $this->delete('/admin/profiles/' . $profile->id);

        $this->assertResponseStatus(302);
        $this->assertSessionMissing('errors');

        $this->notSeeInDatabase('profiles', ['id' => $profile->id]);
    }

    /**
     *@test
     */
    public function only_a_super_admin_can_delete_a_profile()
    {
        $profile = factory(Profile::class)->create(['user_id' => null]);
        $this->asLoggedInContributor();

        $this->delete('/admin/profiles/' . $profile->id);

        $this->assertResponseStatus(403);
        $this->seeInDatabase('profiles', ['id' => $profile->id]);
    }

    /**
     *@test
     */
    public function a_profile_that_has_a_user_cannot_be_directly_deleted()
    {
        $profile = factory(User::class)->create()->createProfile();
        $this->asLoggedInUser();

        $this->delete('/admin/profiles/' . $profile->id);

        $this->assertResponseStatus(302);

        $this->seeInDatabase('profiles', ['id' => $profile->id]);
    }
}