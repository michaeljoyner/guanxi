<?php

namespace Test\Unit\Testimonials;

use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestimonialsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function can_publish_a_testimonial()
    {
        $testimonial = factory(Testimonial::class)->state('private')->create();

        $testimonial->publish();

        $this->assertTrue($testimonial->fresh()->is_published);
    }

    /**
     *@test
     */
    public function testimonial_can_be_retracted()
    {
        $testimonial = factory(Testimonial::class)->state('public')->create();

        $testimonial->retract();

        $this->assertFalse($testimonial->fresh()->is_published);
    }

    /**
     *@test
     */
    public function scope_testimonials_to_public()
    {
        factory(Testimonial::class, 4)->state('public')->create();
        factory(Testimonial::class, 3)->state('private')->create();

        $retrieved = Testimonial::public()->get();

        $this->assertCount(4, $retrieved);

        $retrieved->each(function($testimonial) {
            $this->assertTrue($testimonial->is_published);
        });
    }

    /**
     *@test
     */
    public function scope_to_english()
    {
        factory(Testimonial::class, 4)->create(['language' => 'en']);
        factory(Testimonial::class, 3)->create(['language' => 'zh']);

        $retrieved = Testimonial::english()->get();

        $this->assertCount(4, $retrieved);

        $retrieved->each(function($testimonial) {
            $this->assertEquals('en', $testimonial->language);
        });
    }

    /**
     *@test
     */
    public function scope_to_chinese()
    {
        factory(Testimonial::class, 4)->create(['language' => 'en']);
        factory(Testimonial::class, 3)->create(['language' => 'zh']);

        $retrieved = Testimonial::chinese()->get();

        $this->assertCount(3, $retrieved);

        $retrieved->each(function($testimonial) {
            $this->assertEquals('zh', $testimonial->language);
        });
    }

    /**
     *@test
     */
    public function scopeToLocale()
    {
        factory(Testimonial::class, 4)->create(['language' => 'en']);
        factory(Testimonial::class, 3)->create(['language' => 'zh']);

        app()->setLocale('zh');
        $retrieved = Testimonial::forLocale()->get();

        $this->assertCount(3, $retrieved);

        $retrieved->each(function($testimonial) {
            $this->assertEquals('zh', $testimonial->language);
        });

        app()->setLocale('en-US');
        $retrieved = Testimonial::forLocale()->get();

        $this->assertCount(4, $retrieved);

        $retrieved->each(function($testimonial) {
            $this->assertEquals('en', $testimonial->language);
        });
    }
}