<?php


use App\Affiliates\Affiliate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AffiliatesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_affiliate_is_correctly_stored()
    {
        $this->asLoggedInUser();

        $this->post('/admin/affiliates', ['name' => 'The Frog'])
            ->assertResponseStatus(302)
            ->seeInDatabase('affiliates', [
                'name'     => 'The Frog',
                'location' => json_encode(['en' => '', 'zh' => '']),
                'writeup'  => json_encode(['en' => '', 'zh' => '']),
                'website'  => null,
                'phone'    => null
            ]);
    }

    /**
     * @test
     */
    public function an_affiliate_is_correctly_updated()
    {
        $this->asLoggedInUser();
        $affiliate = factory(Affiliate::class)->create();

        $this->post('/admin/affiliates/' . $affiliate->id, [
            'name'        => 'The Frog',
            'location'    => '123 Sesame Str',
            'zh_location' => 'Yi bai er shi san sesame lu',
            'writeup'     => 'Cool place, nice mexiacn food',
            'zh_writeup'  => 'Wo xihuan zhege difang',
            'website'     => 'http://frog.tw',
            'phone'       => '0912356478'
        ])->assertResponseStatus(302)
            ->seeInDatabase('affiliates', [
                'name'     => 'The Frog',
                'location' => json_encode(['en' => '123 Sesame Str', 'zh' => 'Yi bai er shi san sesame lu']),
                'writeup'  => json_encode(['en' => 'Cool place, nice mexiacn food', 'zh' => 'Wo xihuan zhege difang']),
                'website'  => 'http://frog.tw',
                'phone'    => '0912356478'
            ]);
    }

    /**
     *@test
     */
    public function an_affiliate_can_be_deleted()
    {
        $this->asLoggedInUser();
        $affiliate = factory(Affiliate::class)->create();

        $this->delete('/admin/affiliates/' . $affiliate->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('affiliates', ['id' => $affiliate->id]);
    }

    /**
     *@test
     */
    public function an_affiliates_social_links_are_properly_updated()
    {
        $this->asLoggedInUser();
        $affiliate = factory(Affiliate::class)->create();

        $this->post('/admin/affiliates/' . $affiliate->id, [
            'name'        => 'The Frog',
            'location'    => '123 Sesame Str',
            'zh_location' => 'Yi bai er shi san sesame lu',
            'writeup'     => 'Cool place, nice mexiacn food',
            'zh_writeup'  => 'Wo xihuan zhege difang',
            'website'     => 'http://frog.tw',
            'phone'       => '0912356478',
            'facebook' => 'https://facebook.com/frog',
            'twitter' => 'https://twitter.com/frog'
        ])->assertResponseStatus(302)
            ->seeInDatabase('affiliates', [
                'name'     => 'The Frog',
                'location' => json_encode(['en' => '123 Sesame Str', 'zh' => 'Yi bai er shi san sesame lu']),
                'writeup'  => json_encode(['en' => 'Cool place, nice mexiacn food', 'zh' => 'Wo xihuan zhege difang']),
                'website'  => 'http://frog.tw',
                'phone'    => '0912356478'
            ])->seeInDatabase('social_links', [
                'platform' => 'facebook',
                'link' => 'https://facebook.com/frog',
                'sociable_id' => $affiliate->id,
                'sociable_type' => Affiliate::class
            ])->seeInDatabase('social_links', [
                'platform' => 'twitter',
                'link' => 'https://twitter.com/frog',
                'sociable_id' => $affiliate->id,
                'sociable_type' => Affiliate::class
            ]);
    }
}