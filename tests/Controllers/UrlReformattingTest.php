<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class UrlReformattingTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function a_website_field_with_missing_http_is_reformatted_and_passes_validation()
    {
        $this->asLoggedInUser();

        $this->post('/admin/affiliates', ['name' => 'The Frog', 'website' => 'frog.co.tw'])
            ->assertResponseStatus(302)
//            ->assertSessionMissing('errors')
            ->seeInDatabase('affiliates', [
                'name'     => 'The Frog',
                'location' => json_encode(['en' => '', 'zh' => '']),
                'writeup'  => json_encode(['en' => '', 'zh' => '']),
                'website'  => 'http://frog.co.tw',
                'phone'    => null
            ]);
    }

    /**
     *@test
     */
    public function an_email_field_is_not_reformatted()
    {
        $affiliate = factory(\App\Affiliates\Affiliate::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/affiliates/' . $affiliate->id, [
            'name'        => 'The Frog',
            'location'    => '123 Sesame Str',
            'zh_location' => 'Yi bai er shi san sesame lu',
            'writeup'     => 'Cool place, nice mexiacn food',
            'zh_writeup'  => 'Wo xihuan zhege difang',
            'website'     => 'frog.tw',
            'phone'       => '0912356478',
            'email' => 'frog@hi-net.com.tw'
        ]);
        $this->assertEquals('frog@hi-net.com.tw', $affiliate->fresh()->getSocialLink('email'));

        $this->seeInDatabase('affiliates', [
            'id' => $affiliate->id,
            'website' => 'http://frog.tw',
        ]);
    }

    /**
     *@test
     */
    public function social_links_are_all_reformatted_to_use_https()
    {
        $affiliate = factory(\App\Affiliates\Affiliate::class)->create();
        $this->asLoggedInUser();

        $this->post('/admin/affiliates/' . $affiliate->id, [
            'name'        => 'The Frog',
            'location'    => '123 Sesame Str',
            'zh_location' => 'Yi bai er shi san sesame lu',
            'writeup'     => 'Cool place, nice mexiacn food',
            'zh_writeup'  => 'Wo xihuan zhege difang',
            'website'     => 'frog.tw',
            'phone'       => '0912356478',
            'email' => 'frog@hi-net.com.tw',
            'facebook' => 'facebook.com/me',
            'twitter' => 'twitter.com/me',
            'instagram' => 'instagram.com/me',
            'linkdin' => 'linkdin.com/me'
        ]);
        $this->assertEquals('frog@hi-net.com.tw', $affiliate->fresh()->getSocialLink('email'));
        $this->assertEquals('https://facebook.com/me', $affiliate->fresh()->getSocialLink('facebook'));
        $this->assertEquals('https://twitter.com/me', $affiliate->fresh()->getSocialLink('twitter'));
        $this->assertEquals('https://instagram.com/me', $affiliate->fresh()->getSocialLink('instagram'));
        $this->assertEquals('https://linkdin.com/me', $affiliate->fresh()->getSocialLink('linkdin'));

        $this->seeInDatabase('affiliates', [
            'id' => $affiliate->id,
            'website' => 'http://frog.tw',
        ]);
    }
}