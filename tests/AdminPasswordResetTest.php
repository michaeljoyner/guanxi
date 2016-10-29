<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminPasswordResetTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_logged_in_user_can_reset_their_password()
    {
        $user = $this->asLoggedInUser(); //current password is password

        $this->visit('/admin/users/' . $user->id . '/password/edit')
            ->type('password', 'current_password')
            ->type('newpassword', 'password')
            ->type('newpassword', 'password_confirmation')
            ->press('Reset Password');

        $this->assertTrue(Auth::guard()->attempt(['email' => 'joe@example.com', 'password' => 'newpassword']));
    }
}