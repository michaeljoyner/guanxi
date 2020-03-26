<?php


namespace Test\Feauture\Testimonials;


use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublishTestimonialTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *@test
     */
    public function publish_a_testimonial()
    {
        $this->withoutExceptionHandling();

        $testimonial = factory(Testimonial::class)->state('private')->create();

        $response = $this->asSuperAdmin()->postJson("/admin/published-testimonials", [
            'testimonial_id' => $testimonial->id,
        ]);
        $response->assertSuccessful();

        $this->assertDatabaseHas('testimonials', [
            'id' => $testimonial->id,
            'is_published' => true,
        ]);
    }

    /**
     *@test
     */
    public function only_super_admins_can_publish()
    {
        $testimonial = factory(Testimonial::class)->state('private')->create();

        $response = $this->asLoggedInContributor()->postJson("/admin/published-testimonials", [
            'testimonial_id' => $testimonial->id,
        ]);

        $this->assertForbiddenResponse($response);
    }
}