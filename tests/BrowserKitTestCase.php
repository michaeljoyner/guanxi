<?php

use App\Exceptions\Handler;
use App\User;
use Illuminate\Contracts\Debug\ExceptionHandler;

abstract class BrowserKitTestCase extends \Laravel\BrowserKitTesting\TestCase
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

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        \Illuminate\Support\Facades\Hash::setRounds(4);

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

    public function asLoggedInContributor()
    {
        $user = factory(User::class)->create(['email' => 'mo@example.com', 'password' => 'password']);
        $user->assignRole(\App\Role::editor());
        $user->createProfile();
        $this->actingAs($user);

        return $user;
    }

    public function assertSoftDeleted(\Illuminate\Database\Eloquent\Model $model)
    {
        $model = $model->withTrashed()->find($model->id);
        $this->assertTrue($model->trashed());
    }
}
