<?php


namespace Test\Feature\Slideshows;


use App\Content\Article;
use App\Content\Slideshow;
use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AttachSlideshowImageTest extends TestCase
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
    public function attach_image_to_slideshow()
    {
        $this->withoutExceptionHandling();

        $slideshow = factory(Slideshow::class)->create();

        $response = $this
            ->asSuperAdmin()
            ->postJson("/admin/slideshows/{$slideshow->id}/images", [
                'file' => UploadedFile::fake()->image('testpic.png')
            ]);
        $response->assertSuccessful();

        $this->assertCount(1, $slideshow->getMedia(Slideshow::SLIDES));

        $image = $slideshow->fresh()->getFirstMedia(Slideshow::SLIDES);
        $this->assertMediaExists($image);

    }

    /**
     *@test
     */
    public function contributor_cannot_add_to_others_slideshow()
    {
        $contributorA = factory(Profile::class)->create([
            'user_id' => factory(User::class)->state('contributor')
        ]);
        $contributorB = factory(Profile::class)->create([
            'user_id' => factory(User::class)->state('contributor')
        ]);

        $article = factory(Article::class)->create(['profile_id' => $contributorA->id]);
        $slideshow = factory(Slideshow::class)->create(['article_id' => $article->id]);

        $response = $this
            ->actingAs($contributorB->fresh()->user)
            ->postJson("/admin/slideshows/{$slideshow->id}/images", [
                'file' => UploadedFile::fake()->image('testpic.png')
            ]);
        $this->assertForbiddenResponse($response);
    }
}