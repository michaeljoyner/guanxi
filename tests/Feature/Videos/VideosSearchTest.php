<?php


namespace Tests\Feature\Videos;


use App\Media\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VideosSearchTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function search_for_videos_based_on_title()
    {
        $this->withoutExceptionHandling();

        $videoA = factory(Video::class)->create([
            'title' => ['en' => "find me", 'zh' => "zh find me"],
        ]);
        $videoB = factory(Video::class)->create([
            'title' => ['en' => "look and", 'zh' => "you will find"],
        ]);
        $videoC = factory(Video::class)->create([
            'title' => ['en' => "sad and ", 'zh' => "unwanted"],
        ]);

        $response = $this->asSuperAdmin()->getJson("/admin/media/search/videos?q=find");
        $response->assertSuccessful();

        $found = $response->json();

        $this->assertCount(2, $found);
        $this->assertTrue(collect($found)->contains(fn ($a) => $a['id'] === $videoA->id));
        $this->assertTrue(collect($found)->contains(fn ($a) => $a['id'] === $videoB->id));
    }
}