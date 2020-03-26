<?php


namespace Test\Feauture\Testimonials;


use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadTestimonialAvatarTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake();
        config(['medialibrary.disk_name' => 'media']);
    }

    /**
     *@test
     */
    public function can_upload_avatar_image_for_testimonial()
    {
        $this->withoutExceptionHandling();

        $testimonial = factory(Testimonial::class)->create();

        $response = $this->asSuperAdmin()->postJson("/admin/testimonials/{$testimonial->id}/avatar", [
            'image' => UploadedFile::fake()->image('testpic.png')
        ]);

        $response->assertSuccessful();

        $this->assertCount(1, $testimonial->fresh()->getMedia(Testimonial::AVATARS));
    }


}