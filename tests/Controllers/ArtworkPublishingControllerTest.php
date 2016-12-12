<?php


use App\Media\Artwork;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtworkPublishingControllerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_artwork_is_correctly_published()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create(['published' => false]);

        $this->post('/admin/media/artworks/' . $artwork->id . '/publish', ['publish' => true])
            ->assertResponseOk()
            ->seeJson(['new_state' => true])
            ->seeInDatabase('artworks', ['id' => $artwork->id, 'published' => 1]);
    }
    
    /**
     *@test
     */
    public function an_artwork_is_correctly_retracted()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create(['published' => true]);

        $this->post('/admin/media/artworks/' . $artwork->id . '/publish', ['publish' => false])
            ->assertResponseOk()
            ->seeJson(['new_state' => false])
            ->seeInDatabase('artworks', ['id' => $artwork->id, 'published' => 0]);
    }
}