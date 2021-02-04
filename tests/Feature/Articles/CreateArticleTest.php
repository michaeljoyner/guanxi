<?php


namespace Tests\Feature\Articles;


use App\Content\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     *@test
     */
    public function create_a_new_article()
    {
        $this->withoutExceptionHandling();

        $response = $this->asSuperAdmin()->post("/admin/content/articles", [
            'title' => 'test title',
            'lang' => 'en',
            'designation' => Article::TAIWAN,
        ]);

        $response->assertSuccessful();

        $this->assertDatabaseHas('articles', [
            'title' => json_encode(['en' => "test title", 'zh' => ""]),
            'designation' => Article::TAIWAN,
        ]);
    }

    /**
     *@test
     */
    public function the_designation_is_required_as_taiwan_or_world()
    {

        $response = $this->asSuperAdmin()->from('/articleform')->post("/admin/content/articles", [
            'title' => 'test title',
            'lang' => 'en',
            'designation' => null,
        ]);

        $response->assertRedirect('/articleform');
        $response->assertSessionHasErrors('designation');

        $response = $this->asLoggedInContributor()->from('/articleform')->post("/admin/content/articles", [
            'title' => 'test title',
            'lang' => 'en',
            'designation' => 'not-an-excepted-designation',
        ]);

        $response->assertRedirect('/articleform');
        $response->assertSessionHasErrors('designation');
    }
}