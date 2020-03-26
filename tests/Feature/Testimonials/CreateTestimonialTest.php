<?php

namespace Test\Feauture\Testimonials;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateTestimonialTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function create_a_new_testimonial()
    {
        $this->withoutExceptionHandling();

        $response = $this->asSuperAdmin()->postJson("/admin/testimonials", [
            'name' => 'test name',
            'language' => 'en',
            'content' => 'text content'
        ]);
        $response->assertSuccessful();

        $this->assertDatabaseHas('testimonials', [
            'name' => 'test name',
            'language' => 'en',
            'content' => 'text content'
        ]);
    }

    /**
     *@test
     */
    public function testimonials_can_only_be_added_by_super_admins()
    {
        $response = $this->asLoggedInContributor()->postJson("/admin/testimonials", [
            'name' => 'test name',
            'language' => 'en',
            'content' => 'text content'
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
    public function the_language_must_be_either_en_or_zh()
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
        $valid = [
            'name' => 'test name',
            'language' => 'en',
            'content' => 'text content'
        ];

        $response = $this->asSuperAdmin()->postJson("/admin/testimonials", array_merge($valid, $field));

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(array_keys($field)[0]);
    }
}