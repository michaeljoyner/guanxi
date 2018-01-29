<?php


use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_be_deleted()
    {
        $this->asLoggedInUser();
        $user = factory(User::class)->create();
        $user->createProfile();

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

    /**
     *@test
     */
    public function a_user_can_only_be_deleted_by_a_superadmin()
    {
        $non_super_admin = $this->asLoggedInContributor();
        $user = factory(User::class)->create();
        $user->createProfile();

        $this->delete('/admin/users/' . $user->id)
            ->assertResponseStatus(302)
            ->seeInDatabase('users', ['id' => $user->id]);
    }
}