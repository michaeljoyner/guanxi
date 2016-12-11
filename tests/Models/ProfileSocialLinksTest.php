<?php


use App\People\Profile;
use App\Social\SocialLink;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileSocialLinksTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_social_link_can_be_added_to_a_profile()
    {
        $profile = factory(Profile::class)->create();

        $link = $profile->setSocialLink('facebook', 'https://facebook.com/mp-cool-profile');

        $this->assertCount(1, $profile->socialLinks);
        $this->assertInstanceOf(SocialLink::class, $link);
    }
}