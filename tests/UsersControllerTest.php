<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_be_deleted()
    {
        $this->asLoggedInUser();
        $user = factory(User::class)->create();

        $this->delete('/admin/users/' . $user->id)
            ->assertRedirectedTo('/admin/users')
            ->notSeeInDatabase('users', ['id' => $user->id]);
    }

    /**
     * @test
     */
    public function a_users_info_is_updated()
    {
        $user = $this->asLoggedInUser();

        $this->post('/admin/users/' . $user->id, [
            'name'    => 'New Name',
            'email'   => 'new@email.con',
            'role_id' => \App\Role::editor()->id
        ])->assertRedirectedTo('/admin/users/' . $user->id);

        $user = $user->fresh();

        $this->assertEquals('New Name', $user->name);
        $this->assertEquals('new@email.con', $user->email);
        $this->assertTrue($user->isEditor());
    }
}