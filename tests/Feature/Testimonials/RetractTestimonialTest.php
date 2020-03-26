<?php


namespace Test\Feauture\Testimonials;


use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RetractTestimonialTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function retract_a_published_testimonial()
    {
        $this->withoutExceptionHandling();

        $testimonial = factory(Testimonial::class)->state('public')->create();

        $response = $this->asSuperAdmin()->deleteJson("/admin/published-testimonials/{$testimonial->id}");
        $response->assertSuccessful();

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'is_published' => false,
        ]);
    }

    /**
     *@test
     */
    public function only_super_admins_can_retract()
    {
        $testimonial = factory(Testimonial::class)->state('public')->create();

        $response = $this
            ->asLoggedInContributor()
            ->deleteJson("/admin/published-testimonials/{$testimonial->id}");

        $this->assertForbiddenResponse($response);
    }
}