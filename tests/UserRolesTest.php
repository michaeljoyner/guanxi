<?php


use App\Role;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserRolesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_user_may_be_assigned_a_role()
    {
        $user = factory(User::class)->create();
        $user2 = factory(User::class)->create();
        $user3 = factory(User::class)->create();
        $user4 = factory(User::class)->create();

        $user->assignRole(Role::superadmin());
        $user2->assignRole(Role::editor());
        $user3->assignRole(Role::writer());

        $this->assertTrue($user->isSuperAdmin());
        $this->assertFalse($user->isEditor());
        $this->assertFalse($user->isWriter());

        $this->assertFalse($user2->isSuperAdmin());
        $this->assertTrue($user2->isEditor());
        $this->assertFalse($user2->isWriter());

        $this->assertFalse($user3->isSuperAdmin());
        $this->assertFalse($user3->isEditor());
        $this->assertTrue($user3->isWriter());

        $this->assertFalse($user4->isSuperAdmin());
        $this->assertFalse($user4->isEditor());
        $this->assertFalse($user4->isWriter());
    }

    /**
     *@test
     */
    public function a_user_may_be_assigned_a_role_by_passing_a_role_id_to_assign_role_method()
    {
        $role = Role::superadmin();
        $user = factory(User::class)->create();

        $user->assignRole($role->id);

        $this->assertTrue($user->isSuperAdmin());
    }
}