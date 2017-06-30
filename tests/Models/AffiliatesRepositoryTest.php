<?php


use App\Affiliates\Affiliate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AffiliatesRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new \App\Affiliates\AffiliatesRepository;
    }

    /**
     * @test
     */
    public function it_can_fetch_an_existing_affiliate_by_its_slug()
    {
        $affiliate = factory(Affiliate::class)->create(['slug' => 'the-slug']);

        $result = $this->repo->bySlug('the-slug');

        $this->assertEquals($affiliate->id, $result->id);

    }

    /**
     * @test
     */
    public function it_can_get_the_next_affiliate_which_is_the_one_previous_in_chronological_order()
    {
        $affiliateA = factory(Affiliate::class)->create([
            'published'  => 1,
            'created_at' => \Carbon\Carbon::now()->subDays(5)
        ]);
        $affiliateB = factory(Affiliate::class)->create([
            'published'  => 1,
            'created_at' => \Carbon\Carbon::now()->subDays(10)
        ]);
        $affiliateC = factory(Affiliate::class)->create([
            'published'  => 1,
            'created_at' => \Carbon\Carbon::now()->subDays(15)
        ]);

        $result = $this->repo->getNextInLineAfter($affiliateB);

        $this->assertEquals($affiliateC->id, $result->id);
    }

    /**
     *@test
     */
    public function it_wont_return_an_unpublished_affiliate_as_next_in_line()
    {
        $affiliateA = factory(Affiliate::class)->create([
            'published'  => true,
            'created_at' => \Carbon\Carbon::now()->subDays(5)
        ]);
        $affiliateB = factory(Affiliate::class)->create([
            'published'  => false,
            'created_at' => \Carbon\Carbon::now()->subDays(10)
        ]);
        $affiliateC = factory(Affiliate::class)->create([
            'published'  => true,
            'created_at' => \Carbon\Carbon::now()->subDays(15)
        ]);

        $result = $this->repo->getNextInLineAfter($affiliateA);

        $this->assertEquals($affiliateC->id, $result->id);
    }

    /**
     *@test
     */
    public function the_next_in_line_affiliate_of_the_oldest_is_the_newest_affiliate()
    {
        $affiliateA = factory(Affiliate::class)->create([
            'published'  => 1,
            'created_at' => \Carbon\Carbon::now()->subDays(5)
        ]);
        $affiliateB = factory(Affiliate::class)->create([
            'published'  => 1,
            'created_at' => \Carbon\Carbon::now()->subDays(10)
        ]);
        $affiliateC = factory(Affiliate::class)->create([
            'published'  => 1,
            'created_at' => \Carbon\Carbon::now()->subDays(15)
        ]);

        $result = $this->repo->getNextInLineAfter($affiliateC);

        $this->assertEquals($affiliateA->id, $result->id);
    }
}