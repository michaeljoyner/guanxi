<?php


namespace Test\Feature\Slideshows;


use App\Content\Slideshow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteSlideshowImageTest extends TestCase
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
    public function delete_a_slideshow_image()
    {
        $this->withoutExceptionHandling();

        $slideshow = factory(Slideshow::class)->create();
        $image = $slideshow->addImage(UploadedFile::fake()->image('testpic.png'));

        $response = $this->asSuperAdmin()->deleteJson("/admin/slideshow-images/{$image->id}");
        $response->assertSuccessful();

        $this->assertDatabaseMissing('media', ['id' => $image->id]);
    }
}