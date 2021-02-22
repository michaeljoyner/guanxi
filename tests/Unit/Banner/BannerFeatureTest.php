<?php

namespace Tests\Unit\Banner;

use App\Content\Article;
use App\Content\BannerFeature;
use App\Media\Video;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BannerFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function can_create_banner_feature_from_article()
    {
        $article = factory(Article::class)->create();

        $banner_feature = BannerFeature::fromArticle($article);

        $this->assertSame($article->id, $banner_feature->feature_id);
        $this->assertSame(Article::class, $banner_feature->feature_type);
        $this->assertSame($article->getTranslation('title', 'en'), $banner_feature->title('en'));
        $this->assertSame($article->fullSlug(), $banner_feature->linksTo());
    }

    /**
     *@test
     */
    public function can_create_a_banner_feature_from_video()
    {
        $video = factory(Video::class)->create();

        $banner_feature = BannerFeature::fromVideo($video);

        $this->assertSame($video->id, $banner_feature->feature_id);
        $this->assertSame(Video::class, $banner_feature->feature_type);
        $this->assertSame($video->getTranslation('title', 'en'), $banner_feature->title('en'));
        $this->assertSame($video->fullSlug(), $banner_feature->linksTo());

    }
}
