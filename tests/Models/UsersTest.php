<?php


use App\People\Profile;
use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_new_user_can_be_registered_by_the_user_class()
    {
        $userData = [
            'name' => 'Soapy Joe',
            'email' => 'joe@example.com',
            'password' => 'password'
        ];

        $user = User::registerNew($userData);

        $this->assertEquals('Soapy Joe', $user->name);
        $this->assertEquals('joe@example.com', $user->email);
        $this->assertTrue(Hash::check('password', $user->password));
    }

    /**
     *@test
     */
    public function a_registered_users_role_is_correctly_assigned_if_included_in_attributes()
    {
        $super = Role::superadmin();
        $contributer = Role::writer();
        $userData = [
            'name' => 'Soapy Joe',
            'email' => 'joe@example.com',
            'password' => 'password',
            'role_id' => $super->id
        ];

        $user = User::registerNew($userData);

        $this->assertEquals($super->id, $user->role_id);
    }

    /**
     *@test
     */
    public function if_the_users_role_id_is_not_included_it_will_be_assigned_the_role_of_writer()
    {
        $super = Role::superadmin();
        $contributer = Role::writer();
        $userData = [
            'name' => 'Soapy Joe',
            'email' => 'joe@example.com',
            'password' => 'password',
        ];

        $user = User::registerNew($userData);

        $this->assertEquals($contributer->id, $user->role_id);
    }

    /**
     *@test
     */
    public function if_a_user_is_registered_without_the_profile_param_a_profile_will_be_created_for_the_user()
    {
        $super = Role::superadmin();
        $userData = [
            'name' => 'Soapy Joe',
            'email' => 'joe@example.com',
            'password' => 'password',
            'role_id' => $super->id
        ];

        $user = User::registerNew($userData);

        $this->assertNotNull($user->profile);
    }

    /**
     *@test
     */
    public function if_a_profile_is_passed_as_the_second_param_it_will_be_used_as_the_users_profile()
    {
        $profile = factory(Profile::class)->create(['user_id' => null]);
        $super = Role::superadmin();
        $userData = [
            'name' => 'Soapy Joe',
            'email' => 'joe@example.com',
            'password' => 'password',
            'role_id' => $super->id
        ];

        $user = User::registerNew($userData, $profile);

        $this->assertEquals($profile->fresh()->user_id, $user->id);
    }

    /**
     *@test
     */
    public function if_the_profile_passed_to_register_new_method_has_a_user_an_exception_is_thrown()
    {
        $user = factory(User::class)->create();
        $profile = $user->createProfile();
        $super = Role::superadmin();
        $userData = [
            'name' => 'Soapy Joe',
            'email' => 'joe@example.com',
            'password' => 'password',
            'role_id' => $super->id
        ];

        try {
            $user = User::registerNew($userData, $profile);
            $this->fail('An exception was expected');
        } catch(Exception $e) {
            $this->assertEquals('Profile already has a user', $e->getMessage());
        }

        $this->assertEquals($profile->fresh()->user_id, $user->id);
    }
}