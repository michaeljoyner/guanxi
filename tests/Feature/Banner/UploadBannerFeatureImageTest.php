<?php


namespace Tests\Feature\Banner;


use App\Content\BannerFeature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UploadBannerFeatureImageTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function upload_a_banner_feature_image()
    {
        Storage::fake('test_media', config('filesystems.disks.test_media'));
        $this->withoutExceptionHandling();

        $feature = factory(BannerFeature::class)->create();

        $response = $this
            ->asSuperAdmin()
            ->postJson("/admin/content/banner/features/{$feature->id}/image", [
                'image' => UploadedFile::fake()->image('test.png'),
            ]);

        $response->assertSuccessful();

        $this->assertCount(1, $feature->fresh()->getMedia(BannerFeature::IMAGES));
    }

    /**
     *@test
     */
    public function the_image_must_be_a_valid_image_file()
    {
        Storage::fake('test_media', config('filesystems.disks.test_media'));

        $feature = factory(BannerFeature::class)->create();
        $this->asLoggedInUser();

        $response = $this
            ->postJson("/admin/content/banner/features/{$feature->id}/image", [
                'image' => null,
            ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('image');

        $response = $this
            ->postJson("/admin/content/banner/features/{$feature->id}/image", [
                'image' => 'not-a-file',
            ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('image');

        $response = $this
            ->postJson("/admin/content/banner/features/{$feature->id}/image", [
                'image' => UploadedFile::fake()->create('not-an-image.txt'),
            ]);
        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $response->assertJsonValidationErrors('image');
    }
}