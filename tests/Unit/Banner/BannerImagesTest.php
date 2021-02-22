<?php


namespace Tests\Unit\Banner;


use App\Content\BannerFeature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Tests\TestCase;

class BannerImagesTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function add_an_image_for_the_banner_feature()
    {
        Storage::fake('test_media', config('filesystems.disks.test_media'));

        $feature = factory(BannerFeature::class)->create();

        $upload = UploadedFile::fake()->image('test.png');

        $image = $feature->setImage($upload);

        $this->assertSame($upload->hashName(), $image->file_name);

        $this->assertTrue($image->fresh()->hasGeneratedConversion('web'));

        Storage::disk('test_media')->assertExists(Str::after($image->getUrl(), 'media/'));
    }

    /**
     *@test
     */
    public function adding_a_second_image_clears_the_first()
    {
        Storage::fake('test_media', config('filesystems.disks.test_media'));

        $feature = factory(BannerFeature::class)->create();

        $old_image = $feature->setImage(UploadedFile::fake()->image('test.png'));
        $this->assertCount(1, $feature->fresh()->getMedia(BannerFeature::IMAGES));

        $new_image = $feature->setImage(UploadedFile::fake()->image('test2.png'));
        $this->assertCount(1, $feature->fresh()->getMedia(BannerFeature::IMAGES));

        Storage::disk('test_media')->assertMissing(Str::after($old_image->getUrl(), 'media/'));
        Storage::disk('test_media')->assertExists(Str::after($new_image->getUrl(), 'media/'));
    }

    /**
     *@test
     */
    public function can_clear_the_image()
    {
        Storage::fake('test_media', config('filesystems.disks.test_media'));

        $feature = factory(BannerFeature::class)->create();

        $image = $feature->setImage(UploadedFile::fake()->image('test.png'));
        $this->assertCount(1, $feature->fresh()->getMedia(BannerFeature::IMAGES));

        $feature->clearImage();

        $this->assertCount(0, $feature->fresh()->getMedia(BannerFeature::IMAGES));

        Storage::disk('test_media')->assertMissing(Str::after($image->getUrl(), 'media/'));

    }
}