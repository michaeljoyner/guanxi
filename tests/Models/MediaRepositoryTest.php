<?php


use App\Media\Artwork;
use App\Media\Photo;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class MediaRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->repo = new \App\Media\MediaRepository;
    }

    /**
     *@test
     */
    public function the_repository_can_fetch_mixed_photos_and_artworks()
    {
        $photos = factory(Photo::class, 3)->create(['published' => true]);
        $artworks = factory(Artwork::class, 3)->create(['published' => true]);

        $results = $this->repo->latestArtAndPhotos(6);

        $this->assertCount(6, $results);

        $photos->each(function($photo) use ($results) {
            $this->assertArrayHasKey($photo->id, $results->pluck('title', 'id')->toArray());
        });

        $artworks->each(function($artwork) use ($results) {
            $this->assertArrayHasKey($artwork->id, $results->pluck('title', 'id')->toArray());
        });
    }

    /**
     *@test
     */
    public function unpublished_media_is_not_returned_as_latest_art_and_photos()
    {
        $photos = factory(Photo::class, 3)->create(['published' => false]);
        $artworks = factory(Artwork::class, 3)->create(['published' => false]);

        $results = $this->repo->latestArtAndPhotos(6);

        $this->assertCount(0, $results);
    }
}