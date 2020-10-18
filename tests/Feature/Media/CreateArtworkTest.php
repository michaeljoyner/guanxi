<?php

namespace Tests\Feature\Media;

use App\Media\Artwork;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateArtworkTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_an_new_artwork()
    {
        $this->withoutExceptionHandling();
        $this->asLoggedInUser();

        $response = $this->post('/admin/media/artworks', ['title' => 'The artful dodger', 'description' => 'desc']);
        $response->assertSuccessful();

        $this->assertDatabaseHas('artworks', [
            'title'       => json_encode(['en' => 'The artful dodger', 'zh' => '']),
            'description' => json_encode(['en' => 'desc', 'zh' => ''])
        ]);
    }

    /**
     * @test
     */
    public function update_an_artwork()
    {
        $this->withoutExceptionHandling();
        $this->asLoggedInUser();

        $artwork = factory(Artwork::class)->create(['description' => ['en' => 'old desc']]);

        $response = $this->post('/admin/media/artworks/' . $artwork->id, [
            'title'          => 'New arty title',
            'zh_title'       => 'Chinese arty title',
            'description'    => 'new desc',
            'zh_description' => 'a wonderful xingrong'
        ]);
        $response->assertRedirect("/admin/media/artworks/{$artwork->id}");
        $this->assertDatabaseHas('artworks', [
            'id'          => $artwork->id,
            'title'       => json_encode(['en' => 'New arty title', 'zh' => 'Chinese arty title']),
            'description' => json_encode(['en' => 'new desc', 'zh' => 'a wonderful xingrong'])
        ]);
    }
}