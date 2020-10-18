<?php

namespace Test\Unit\Slideshows;

use App\Content\Slideshow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Tests\TestCase;

class SlideshowImagesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        Storage::fake('media');
        config(['media-library.disk_name' => 'media']);
    }

    /**
     *@test
     */
    public function can_add_an_image_to_slideshow()
    {
        $slideshow = factory(Slideshow::class)->create();

        $image = $slideshow->addImage(UploadedFile::fake()->image('testpic.png'));

        $this->assertInstanceOf(Media::class, $image);
        $this->assertCount(1, $slideshow->getMedia(Slideshow::SLIDES));
        $this->assertMediaExists($image);
    }

    /**
     *@test
     */
    public function a_web_conversion_of_the_image_is_made()
    {
        $slideshow = factory(Slideshow::class)->create();

        $image = $slideshow->addImage(UploadedFile::fake()->image('testpic.png'));

        $this->assertTrue($image->fresh()->hasGeneratedConversion('web'));
        $this->assertMediaExists($image, 'web');
    }
}