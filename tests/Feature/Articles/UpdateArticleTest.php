<?php


namespace Tests\Feature\Articles;


use App\Content\Article;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function update_article_info_other_than_body()
    {
        $this->withoutExceptionHandling();

        $article = factory(Article::class)->create([
            'designation' => Article::WORLD,
        ]);

        $response = $this
            ->asSuperAdmin()
            ->post("/admin/content/articles/{$article->id}", [
                'title'          => 'New en title',
                'zh_title'       => 'New zh title',
                'description'    => 'New en description',
                'zh_description' => 'New zh description',
                'designation'    => Article::TAIWAN,
            ]);

        $response->assertRedirect("/admin/content/articles/{$article->id}");

        $this->assertDatabaseHas('articles', [
            'title'       => json_encode(['en' => "New en title", 'zh' => "New zh title"]),
            'description' => json_encode(['en' => "New en description", 'zh' => "New zh description"]),
            'designation' => Article::TAIWAN,
        ]);
    }

    /**
     * @test
     */
    public function the_designation_is_required_as_taiwan_or_world()
    {

        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();
        $user->assignRole(\App\Role::superadmin());
        $user->createProfile();

        $response = $this
            ->actingAs($user)
            ->from('/articleform')
            ->post("/admin/content/articles/{$article->id}", [
                'title'          => 'New en title',
                'zh_title'       => 'New zh title',
                'description'    => 'New en description',
                'zh_description' => 'New zh description',
                'designation'    => null,
            ]);

        $response->assertRedirect('/articleform');
        $response->assertSessionHasErrors('designation');

        $response = $this
            ->actingAs($user)
            ->from('/articleform')
            ->post("/admin/content/articles/{$article->id}", [
                'title'          => 'New en title',
                'zh_title'       => 'New zh title',
                'description'    => 'New en description',
                'zh_description' => 'New zh description',
                'designation'    => 'not-an-excepted-designation',
            ]);

        $response->assertRedirect('/articleform');
        $response->assertSessionHasErrors('designation');
    }
}