<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\User::class)->create([
            'name' => 'Joe Soap',
            'email' => 'joe@example.com',
            'password' => 'password'
        ]);
        $user->assignRole(\App\Role::superadmin());
        $user2 = factory(\App\User::class)->create([
            'name' => 'Edith Editor',
            'email' => 'editor@example.com',
            'password' => 'password'
        ]);
        $user2->assignRole(\App\Role::editor());
        $user3 = factory(\App\User::class)->create([
            'name' => 'Willy Writer',
            'email' => 'writer@example.com',
            'password' => 'password'
        ]);
        $user3->assignRole(\App\Role::writer());
    }
}
