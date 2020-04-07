<?php


namespace Test\Feature\Slideshows;


use App\Content\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateSlideshowsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function create_new_slideshow_for_article()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create();

        $response = $this->asLoggedInContributor()
                         ->postJson("/admin/articles/{$article->id}/slideshows", [
                             'title' => 'test slideshow'
                         ]);
        $response->assertSuccessful();

        $this->assertDatabaseHas('slideshows', [
            'title' => 'test slideshow'
        ]);
    }

    /**
     * @test
     */
    public function the_title_is_required()
    {
        $article = factory(Article::class)->create();
        $response = $this->asLoggedInContributor()
                         ->postJson("/admin/articles/{$article->id}/slideshows", [
                             'title' => null
                         ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');
    }
}