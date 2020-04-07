<?php


namespace Test\Feature\Slideshows;


use App\Content\Article;
use App\Content\Slideshow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteSlideshowTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function delete_an_existing_slideshow()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();
        $slideshow = factory(Slideshow::class)->create(['article_id' => $article->id]);

        $response = $this->asSuperAdmin()->delete("/admin/slideshows/{$slideshow->id}");
        $response->assertRedirect("/admin/content/articles/{$article->id}");

        $this->assertDatabaseMissing('slideshows', ['id' => $slideshow->id]);

    }
}