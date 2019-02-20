<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class AuthenticationTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_log_in()
    {
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);
        $user->createProfile();

        $this->visit('/admin/login')
            ->type('joe@example.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->seePageIs('/admin');

        $this->assertEquals(Auth::user()->id, $user->id);
    }


}