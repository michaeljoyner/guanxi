<?php


use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiProfilesTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_list_of_all_profiles_can_be_fetched()
    {
        $profiles = factory(Profile::class, 5)->create();
        $this->asLoggedInUser();

        $this->get('/admin/api/profiles')
            ->assertResponseOk();

        $profiles->each(function($profile) {
            $this->seeJson([
                'id' => $profile->id,
                'name' => $profile->name,
                'intro' => $profile->getTranslation('intro', 'en'),
                'thumbnail' => $profile->avatar('thumb')
            ]);
        });

    }
}