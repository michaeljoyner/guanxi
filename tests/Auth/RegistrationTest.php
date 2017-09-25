<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function only_a_logged_in_user_may_create_a_new_user()
    {
        $this->post('/admin/users', [
            'name'                  => 'Joe Soap',
            'email'                 => 'joe@example.com',
            'password'              => 'password',
            'password_confirmation' => 'password'
        ])->assertResponseStatus(302);

        $this->notSeeInDatabase('users', [
            'name'  => 'Joe Soap',
            'email' => 'joe@example.com',
        ]);
    }

    /**
     * @test
     */
    public function a_new_user_may_be_registered_as_a_writer()
    {
        $this->asLoggedInUser();
        $role = \App\Role::writer();

        $this->post('/admin/users', [
            'name'                  => 'Jane Soap',
            'email'                 => 'jane@example.com',
            'role_id'               => $role->id,
            'password'              => 'password',
            'password_confirmation' => 'password'
        ])->assertResponseStatus(302);


        $this->seeInDatabase('users', [
            'email' => 'jane@example.com',
            'role_id' => $role->id
        ]);
        $this->assertCount(2, \App\User::all());
    }

    /**
     * @test
     */
    public function a_user_may_be_registered_as_a_super_admin()
    {
        $this->asLoggedInUser();
        $role = \App\Role::superadmin();

        $this->post('/admin/users', [
            'name'                  => 'Jane Superadmin Soap',
            'email'                 => 'jane@example.com',
            'role_id'               => $role->id,
            'password'              => 'password',
            'password_confirmation' => 'password'
        ])->assertResponseStatus(302);


        $this->seeInDatabase('users', [
            'email'   => 'jane@example.com',
            'role_id' => $role->id
        ]);
    }
}