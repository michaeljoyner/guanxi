<?php

namespace Tests;

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

    protected function disableExceptionHandling()
    {
        $this->app->instance(ExceptionHandler::class, new class extends Handler {
            public function __construct() {}

            public function report(\Throwable $e)
            {
                // no-op
            }

            public function render($request, \Throwable $e) {
                throw $e;
            }

        });
    }

    public function asLoggedInUser()
    {
        $user = factory(User::class)->create(['email' => 'joe@example.com', 'password' => 'password']);
        $user->assignRole(\App\Role::superadmin());
        $user->createProfile();
        $this->actingAs($user);

        return $user;
    }

    public function asSuperAdmin(): self
    {
        $this->asLoggedInUser();

        return $this;
    }

    public function asLoggedInContributor()
    {
        $user = factory(User::class)->create(['email' => 'mo@example.com', 'password' => 'password']);
        $user->assignRole(\App\Role::editor());
        $user->createProfile();
        $this->actingAs($user);

        return $this;
    }

    public function assertForbiddenResponse($response)
    {
        $response->assertStatus(302);
        $this->assertEquals("Forbidden", $response->exception->getMessage());
    }

    public function assertMediaExists($image, $conversion = '')
    {
        Storage::disk('media')->assertExists(Str::after($image->getUrl($conversion), '/storage/'));
    }

    public function assertMediaMissing($image, $conversion = '')
    {
        Storage::disk('media')->assertMissing(Str::after($image->getUrl($conversion), '/storage/'));
    }
}
