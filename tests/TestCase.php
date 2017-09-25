<?php

namespace Tests;

use App\User;

abstract class TestCase extends \Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    public function asLoggedInUser()
    {
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);
        $user->assignRole(\App\Role::superadmin());
        $user->createProfile();
        $this->actingAs($user);

        return $user;
    }

    public function asLoggedInContributor()
    {
        $user = factory(User::class)->create(['email' => 'mo@example.com', 'password' => 'password']);
        $user->assignRole(\App\Role::editor());
        $user->createProfile();
        $this->actingAs($user);

        return $user;
    }
}
