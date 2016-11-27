<?php


use App\Affiliates\Affiliate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AffiliatePublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function an_unpublished_affiliate_is_properly_published()
    {
        $this->asLoggedInUser();
        $affiliate = factory(Affiliate::class)->create();

        $this->post('/admin/affiliates/' . $affiliate->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('affiliates', [
                'id'        => $affiliate->id,
                'published' => 1
            ]);
    }

    /**
     * @test
     */
    public function a_published_affiliate_is_properly_retracted()
    {
        $this->asLoggedInUser();
        $affiliate = factory(Affiliate::class)->create(['published' => true]);

        $this->post('/admin/affiliates/' . $affiliate->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('affiliates', [
                'id'        => $affiliate->id,
                'published' => 0
            ]);
    }
}