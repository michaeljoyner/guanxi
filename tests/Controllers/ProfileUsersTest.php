<?php


use App\People\Profile;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileUsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_user_can_be_registered_for_an_existing_non_user_profile()
    {
        $this->asLoggedInUser();
        $profile = factory(Profile::class)->create(['user_id' => null]);
        $role = Role::editor();

        $this->post('/admin/profiles/' . $profile->id . '/user', [
            'name' => 'Soapy Joe',
            'email' => 'soapy@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role_id' => $role->id
        ]);
        $this->assertResponseStatus(302);
        $this->assertSessionMissing('errors');

        $user = User::where('email', 'soapy@example.com')->first();
        $this->assertTrue(Hash::check('password', $user->password));
        $this->seeInDatabase('users', [
            'name' => 'Soapy Joe',
            'email' => 'soapy@example.com',
            'role_id' => $role->id
        ]);
    }
}