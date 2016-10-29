<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegistrationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function only_a_logged_in_user_may_create_a_new_user()
    {
        $this->post('/admin/users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertResponseStatus(302);

        $this->notSeeInDatabase('users', [
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
        ]);
    }

    /**
     *@test
     */
    public function a_new_user_may_be_registered()
    {
        $this->asLoggedInUser();

        $this->post('/admin/users', [
            'name' => 'Jane Soap',
            'email' => 'jane@example.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ])->assertResponseStatus(302);


        $this->seeInDatabase('users', [
            'name' => 'Jane Soap',
            'email' => 'jane@example.com'
        ]);
        $this->assertCount(2, \App\User::all());
    }
}