<?php

namespace Tests\Feature\Videos;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FetchVideoEmbedCodeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @group integration
     */
    public function a_youtube_videos_embed_code_can_be_fetched_by_posting_url()
    {
        $this->disableExceptionHandling();

        $youtube_url = "https://www.youtube.com/watch?v=dcc1VyGvaYk";

        $expected_embed_code = '<iframe class="absolute inset w-full h-full" src="https://youtube.com/embed/dcc1VyGvaYk" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

        $response = $this->asLoggedInContributor()->json("POST", "/admin/api/video/embed", [
            'url' => $youtube_url
        ]);

        $response->assertStatus(200);

        $this->assertEquals(['embed' => $expected_embed_code], $response->json());
    }

    /**
     * @test
     * @group integration
     */
    public function a_vimeo_videos_embed_code_can_be_fetched_by_posting_url()
    {
        $this->disableExceptionHandling();

        $vimeo_url = "https://vimeo.com/135819339";


        $expected_embed_code = '<iframe class="absolute inset w-full h-full" src="https://player.vimeo.com/video/135819339" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';

        $response = $this->asLoggedInContributor()->json("POST", "/admin/api/video/embed", [
            'url' => $vimeo_url
        ]);

        $response->assertStatus(200);

        $this->assertEquals(['embed' => $expected_embed_code], $response->json());
    }
}