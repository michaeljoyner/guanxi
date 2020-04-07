<?php


namespace Test\Feauture\Testimonials;


use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateTestimonialTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function update_an_existing_testimonial()
    {
        $this->withoutExceptionHandling();

        $testimonial = factory(Testimonial::class)->create();

        $response = $this->asSuperAdmin()->postJson("/admin/testimonials/{$testimonial->id}", [
            'name' => 'new name',
            'language' => 'en',
            'content' => 'new content'
        ]);

        $response->assertRedirect("/admin/testimonials/{$testimonial->id}");

        $this->assertDatabaseHas('testimonials', [
            'name' => 'new name',
            'language' => 'en',
            'content' => 'new content'
        ]);

    }

    /**
     *@test
     */
    public function can_only_be_updated_by_superadmin()
    {
        $testimonial = factory(Testimonial::class)->create();

        $response = $this->asLoggedInContributor()->postJson("/admin/testimonials/{$testimonial->id}", [
            'name' => 'new name',
            'language' => 'en',
            'content' => 'new content'
        ]);

        $this->assertForbiddenResponse($response);
    }

    /**
     *@test
     */
    public function the_name_is_required()
    {
        $this->assertFieldIsInvalid(['name' => null]);
    }

    /**
     *@test
     */
    public function the_language_is_required()
    {
        $this->assertFieldIsInvalid(['language' => null]);
    }

    /**
     *@test
     */
    public function language_code_must_be_en_or_zh()
    {
        $this->assertFieldIsInvalid(['language' => 'de']);
    }

    /**
     *@test
     */
    public function the_content_is_required()
    {
        $this->assertFieldIsInvalid(['content' => null]);
    }

    private function assertFieldIsInvalid($field)
    {
        $testimonial = factory(Testimonial::class)->create();
        $valid = [
            'name' => 'new name',
            'language' => 'en',
            'content' => 'new content'
        ];

        $response = $this
            ->asSuperAdmin()
            ->postJson("/admin/testimonials/{$testimonial->id}", array_merge($valid, $field));

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(array_keys($field)[0]);
    }
}