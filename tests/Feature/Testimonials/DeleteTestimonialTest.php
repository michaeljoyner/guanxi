<?php


namespace Test\Feauture\Testimonials;


use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTestimonialTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function delete_an_existing_testimonial()
    {
        $this->withoutExceptionHandling();

        $testimonial = factory(Testimonial::class)->create();

        $response = $this->asSuperAdmin()->delete("/admin/testimonials/{$testimonial->id}");
        $response->assertRedirect("/admin/testimonials");

        $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
    }

    /**
     *@test
     */
    public function testimonials_can_only_be_deleted_by_a_super_admin()
    {
        $testimonial = factory(Testimonial::class)->create();

        $response = $this->asLoggedInContributor()->delete("/admin/testimonials/{$testimonial->id}");
        $this->assertForbiddenResponse($response);
        $this->assertDatabaseHas('testimonials', ['id' => $testimonial->id]);
    }
}