<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesControllerTest extends TestCase
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
            'intro' => 'Straight outa Nantun'
        ])
            ->assertResponseStatus(302)
            ->seeInDatabase('profiles', [
                'user_id' => null,
                'name'    => 'Mister Donut',
                'title'   => json_encode(['en' => 'Editor', 'zh' => '']),
                'intro'   => json_encode(['en' => 'Straight outa Nantun', 'zh' => '']),
                'bio'     => json_encode(['en' => '', 'zh' => ''])
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
                'sociable_type' => \App\People\Profile::class,
                'platform'   => 'facebook',
                'link'       => 'https://facebook.com'
            ])->seeInDatabase('social_links', [
                'sociable_id' => $user->profile->id,
                'sociable_type' => \App\People\Profile::class,
                'platform'   => 'twitter',
                'link'       => 'https://twitter.com'
            ]);
    }


}