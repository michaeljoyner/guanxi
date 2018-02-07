<?php

namespace Tests\Feature\Profiles;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateProfileTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function the_social_fields_are_not_required()
    {
        $this->disableExceptionHandling();
        $this->asLoggedInUser();

        $user = factory(User::class)->create();
        $profile = $user->createProfile();

        $response = $this->post("/admin/profiles/{$profile->id}", [
            'name' => 'Updated name',
            'zh_name' => 'Updated zh name',
            'intro' => 'Updated intro',
            'zh_intro' => 'Updated zh intro',
            'bio' => 'Updated bio',
            'zh_bio' => 'Updated zh bio',
            'facebook' => '',
            'twitter' => ''
         ]);
        $response->assertRedirect("/admin/profiles/{$profile->id}");


    }
}