<?php


namespace Test\Unit\Slideshows;


use App\Content\Article;
use App\Content\Slideshow;
use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SlideshowTest extends TestCase
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
    public function check_if_can_be_edited_by_a_user()
    {
        $superadmin = factory(User::class)->state('superadmin')->create();
        $author = factory(User::class)->state('contributor')->create();
        $other_person = factory(User::class)->state('contributor')->create();
        factory(Profile::class)->create(['user_id' => $other_person]);

        $profile = factory(Profile::class)->create(['user_id' => $author->id]);
        $article = factory(Article::class)->create(['profile_id' => $profile->id]);

        $slideshow = factory(Slideshow::class)->create(['article_id' => $article->id]);

        $this->assertTrue($slideshow->canBeEditedBy($superadmin));
        $this->assertTrue($slideshow->canBeEditedBy($author));
        $this->assertFalse($slideshow->canBeEditedBy($other_person));

    }

    /**
     *@test
     */
    public function present_as_html()
    {
        $slideshow = factory(Slideshow::class)->create();
        $imageA = $slideshow->addImage(UploadedFile::fake()->image('testone.png'));
        $imageB = $slideshow->addImage(UploadedFile::fake()->image('testtwo.png'));

        $expected = <<<EOD
<div class="guanxi-article-slideshow">
    <img src="{$imageA->getUrl('web')}">
    <img src="{$imageB->getUrl('web')}">
</div>
EOD;

        $this->assertEquals($expected, $slideshow->html());

    }
}