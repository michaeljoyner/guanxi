<?php


use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserProfilesTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_profile_is_created_for_a_new_user()
    {
        $user = User::registerNew(['name' => 'Neo', 'email' => 'neo@rabbithole.com', 'password' => 'password']);

        $this->assertInstanceOf(Profile::class, $user->profile);
    }

    /**
     *@test
     */
    public function deleting_a_user_deletes_its_profile()
    {
        $user = User::create(['name' => 'Neo', 'email' => 'neo@rabbithole.com', 'password' => 'password']);
        $user->createProfile();
        $profile_id = $user->profile->id;

        $user->delete();

        $this->notSeeInDatabase('profiles', [
            'id' => $profile_id
        ]);
    }
}