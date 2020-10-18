<?php


use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_profile_is_correctly_stored()
    {
        $this->asLoggedInUser();

        $this->post('/admin/profiles', [
            'name'  => 'Mister Donut',
            'title' => 'Editor',
            'intro' => 'Straight outa Nantun',
            'bio' => 'bio'
        ])
            ->assertResponseStatus(302)
            ->seeInDatabase('profiles', [
                'user_id' => null,
                'name'    => 'Mister Donut',
                'title'   => json_encode(['en' => 'Editor', 'zh' => '']),
                'intro'   => json_encode(['en' => 'Straight outa Nantun', 'zh' => '']),
                'bio'     => json_encode(['en' => 'bio', 'zh' => ''])
            ]);
    }

    /**
     * @test
     */
    public function a_user_may_edit_their_profile()
    {
        $user = $this->asLoggedInUser();

        $this->post('/admin/profiles/' . $user->profile->id, [
            'name'     => 'New Name',
            'title'    => 'Contributor',
            'zh_title' => 'Xie Ren',
            'intro'    => 'The one, the only',
            'zh_intro' => 'De yige ren',
            'bio'      => 'Born in the USA',
            'zh_bio'   => 'I have no idea'
        ])->assertResponseStatus(302)
            ->seeInDatabase('profiles', [
                'id'    => $user->profile->id,
                'name'  => 'New Name',
                'title' => json_encode(['en' => 'Contributor', 'zh' => 'Xie Ren']),
                'intro' => json_encode(['en' => 'The one, the only', 'zh' => 'De yige ren']),
                'bio'   => json_encode(['en' => 'Born in the USA', 'zh' => 'I have no idea'])
            ]);

    }

    /**
     * @test
     */
    public function a_profiles_social_links_are_correctly_updated()
    {
        $user = $this->asLoggedInUser();

        $this->post('/admin/profiles/' . $user->profile->id, [
            'name'     => 'New Name',
            'facebook' => 'https://facebook.com',
            'twitter'  => 'https://twitter.com'
        ])->assertResponseStatus(302)
            ->seeInDatabase('social_links', [
                'sociable_id' => $user->profile->id,
                'sociable_type' => Profile::class,
                'platform'   => 'facebook',
                'link'       => 'https://facebook.com'
            ])->seeInDatabase('social_links', [
                'sociable_id' => $user->profile->id,
                'sociable_type' => Profile::class,
                'platform'   => 'twitter',
                'link'       => 'https://twitter.com'
            ]);
    }

    /**
     *@test
     */
    public function a_non_superadmin_user_can_only_see_their_profile()
    {
        $contributor = $this->asLoggedInContributor();
        $other_profile = factory(Profile::class)->create();

        $this->visit('/admin/profiles')
            ->dontSee($other_profile->name)
            ->see($contributor->profile->name);
    }

    /**
     *@test
     */
    public function a_non_superadmin_cannot_edit_another_users_profile()
    {
        $contributor = $this->asLoggedInContributor();
        $other_user = factory(User::class)->create();
        $other_user->createProfile();

        $this->post('/admin/profiles/' . $other_user->profile->id, [
            'name'     => 'New Name',
            'title'    => 'Contributor',
            'zh_title' => 'Xie Ren',
            'intro'    => 'The one, the only',
            'zh_intro' => 'De yige ren',
            'bio'      => 'Born in the USA',
            'zh_bio'   => 'I have no idea'
        ])->assertResponseStatus(403)
            ->seeInDatabase('profiles', [
                'id'    => $other_user->profile->id,
                'name'  => $other_user->profile->name
            ]);
    }


}