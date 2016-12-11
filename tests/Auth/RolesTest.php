<?php


use App\Role;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RolesTest extends TestCase
{
    use DatabaseMigrations;
    
    /**
     *@test
     */
    public function a_super_admin_role_exists()
    {
        $role = Role::superadmin();

        $this->assertEquals(Role::SUPER_ADMIN, $role->type);
    }

    /**
     *@test
     */
    public function an_editor_role_exists()
    {
        $role = Role::editor();

        $this->assertEquals(Role::EDITOR, $role->type);
    }

    /**
     *@test
     */
    public function a_writer_role_exists()
    {
        $role = Role::writer();

        $this->assertEquals(Role::WRITER, $role->type);
    }

    /**
     *@test
     */
    public function only_a_single_role_exists_in_the_db_for_a_given_type()
    {
        $role = Role::superadmin();
        $role2 = Role::superadmin();
        $role3 = Role::superadmin();

        $this->assertCount(1, Role::all());
    }
}