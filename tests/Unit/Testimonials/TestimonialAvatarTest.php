<?php


namespace Test\Unit\Testimonials;


use App\Testimonials\Testimonial;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Spatie\MediaLibrary\Models\Media;
use Tests\TestCase;

class TestimonialAvatarTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('media');
        config(['medialibrary.disk_name' => 'media']);
    }

    /**
     *@test
     */
    public function set_avatar_for_testimonial()
    {
        $testimonial = factory(Testimonial::class)->create();

        $avatar = $testimonial->setAvatar(UploadedFile::fake()->image('testpic.png'));

        $this->assertInstanceOf(Media::class, $avatar);
        $this->assertCount(1, $testimonial->getMedia(Testimonial::AVATARS));

        $this->assertMediaExists($avatar);
    }

    /**
     *@test
     */
    public function avatar_can_be_cleared()
    {
        $testimonial = factory(Testimonial::class)->create();
        $avatar = $testimonial->setAvatar(UploadedFile::fake()->image('testpic.png'));
        $this->assertCount(1, $testimonial->getMedia(Testimonial::AVATARS));

        $testimonial->clearAvatar();

        $this->assertCount(0, $testimonial->fresh()->getMedia(Testimonial::AVATARS));
        $this->assertMediaMissing($avatar);
    }

    /**
     *@test
     */
    public function setting_avatar_overwrites_any_previous_one()
    {
        $testimonial = factory(Testimonial::class)->create();
        $original_avatar = $testimonial->setAvatar(UploadedFile::fake()->image('testpic.png'));
        $this->assertCount(1, $testimonial->getMedia(Testimonial::AVATARS));

        $new_avatar = $testimonial->setAvatar(UploadedFile::fake()->image('testpic2.jpg'));

        $this->assertCount(1, $testimonial->fresh()->getMedia(Testimonial::AVATARS));
        $this->assertMediaExists($new_avatar);
        $this->assertMediaMissing($original_avatar);
    }
    
    /**
     *@test
     */
    public function a_thumb_conversion_is_made()
    {
        $testimonial = factory(Testimonial::class)->create();
        /** @var $avatar Media */
        $avatar = $testimonial->setAvatar(UploadedFile::fake()->image('testpic.png'));

        $this->assertTrue($avatar->fresh()->hasGeneratedConversion('thumb'));

        $this->assertMediaExists($avatar, 'thumb');
    }


}