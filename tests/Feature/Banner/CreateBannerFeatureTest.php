<?php

namespace Tests\Feature\Banner;

use App\Content\Article;
use App\Media\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateBannerFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function create_a_banner_feature_from_an_article()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();

        $response = $this->asSuperAdmin()->postJson("/admin/content/banner/feature-article", [
            'article_id' => $article->id,
        ]);
        $response->assertSuccessful();

        $this->assertDatabaseHas("banner_features", [
            'feature_id' => $article->id,
            'feature_type' => Article::class,
        ]);

    }

    /**
     *@test
     */
    public function create_a_banner_feature_from_a_video()
    {
        $this->withoutExceptionHandling();

        $video = factory(Video::class)->create();

        $response = $this->asSuperAdmin()->postJson("/admin/content/banner/feature-video", [
            'video_id' => $video->id,
        ]);
        $response->assertSuccessful();

        $this->assertDatabaseHas("banner_features", [
            'feature_id' => $video->id,
            'feature_type' => Video::class,
        ]);
    }
}