<?php


use App\People\Profile;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BiosRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    protected $repo;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new \App\People\BiosRepository;
    }

    /**
     *@test
     */
    public function it_gets_the_correct_bio_by_its_slug()
    {
        $bio = factory(Profile::class)->create(['published' => true, 'slug' => 'my-slug']);

        $result = $this->repo->bySlug('my-slug');

        $this->assertEquals($result->id, $bio->id);
    }

    /**
     *@test
     */
    public function it_gets_the_next_in_line_bio_after_a_given_bio()
    {
        $bioA = $this->createDatedProfile(Carbon::now()->subDays(5));
        $bioB = $this->createDatedProfile(Carbon::now()->subDays(10));
        $bioC = $this->createDatedProfile(Carbon::now()->subDays(15));

        $result = $this->repo->nextInLineAfter($bioB);

        $this->assertEquals($bioC->id, $result->id);
    }

    /**
     *@test
     */
    public function the_next_in_line_bio_should_not_be_unpublished()
    {
        $bioA = $this->createDatedProfile(Carbon::now()->subDays(5));
        $bioB = $this->createDatedProfile(Carbon::now()->subDays(10), ['published' => false]);
        $bioC = $this->createDatedProfile(Carbon::now()->subDays(15));

        $result = $this->repo->nextInLineAfter($bioA);

        $this->assertEquals($bioC->id, $result->id);
    }

    /**
     *@test
     */
    public function the_next_in_line_for_the_oldest_article_is_the_newest()
    {
        $bioA = $this->createDatedProfile(Carbon::now()->subDays(5));
        $bioB = $this->createDatedProfile(Carbon::now()->subDays(10));
        $bioC = $this->createDatedProfile(Carbon::now()->subDays(15));

        $result = $this->repo->nextInLineAfter($bioC);

        $this->assertEquals($bioA->id, $result->id);
    }

    protected function createDatedProfile($date, $attributes = [])
    {
        return factory(Profile::class)->create(array_merge([
            'published' => true,
            'created_at' => $date
        ], $attributes));
    }
}