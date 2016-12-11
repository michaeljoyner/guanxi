<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;

class AuthenticationTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_log_in()
    {
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);

        $this->visit('/admin/login')
            ->type('joe@example.com', 'email')
            ->type('password', 'password')
            ->press('Login')
            ->seePageIs('/admin');

        $this->assertEquals(Auth::user()->id, $user->id);
    }

    /**
     *@test
     */
    public function a_logged_in_user_can_log_out()
    {
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);
        $this->actingAs($user);

        $this->visit('/admin/logout')
            ->seePageIs('/');

        $this->assertFalse(Auth::check());
    }
}