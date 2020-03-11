<?php


use App\Media\Artwork;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtworksControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_artwork_is_correctly_stored_with_just_a_title()
    {
        $this->asLoggedInUser();

        $this->post('/admin/media/artworks', ['title' => 'The artful dodger'])
            ->assertResponseStatus(200)
            ->seeInDatabase('artworks', [
                'title' => json_encode(['en' => 'The artful dodger', 'zh' => '']),
                'description' => json_encode(['en' => '', 'zh' => ''])
            ]);
    }

    /**
     *@test
     */
    public function an_artworks_title_and_description_are_correctly_updated()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create();

        $this->post('/admin/media/artworks/' . $artwork->id, [
            'title' => 'New arty title',
            'zh_title' => 'Chinese arty title',
            'description' => '',
            'zh_description' => 'a wonderful xingrong'
        ])->assertResponseStatus(302)
            ->seeInDatabase('artworks', [
                'id' => $artwork->id,
                'title' => json_encode(['en' => 'New arty title', 'zh' => 'Chinese arty title']),
                'description' => json_encode(['en' => '', 'zh' => 'a wonderful xingrong'])
            ]);
    }

    /**
     *@test
     */
    public function an_artwork_can_be_deleted()
    {
        $this->asLoggedInUser();
        $artwork = factory(Artwork::class)->create();

        $this->delete('/admin/media/artworks/' . $artwork->id)
            ->assertResponseStatus(302)
            ->notSeeInDatabase('artworks', ['id' => $artwork->id]);
    }
}