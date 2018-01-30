<?php


use App\Content\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiTagsControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_index_of_available_tags_can_be_fetched_as_json()
    {
        $this->asLoggedInUser();
        $tags = factory(Tag::class, 10)->create();

        $this->get('/admin/api/tags')
            ->assertResponseOk();

        $tags->each(function($tag) {
            $this->seeJson([
                'id' => $tag->id,
                'name' => $tag->name
            ]);
        });
    }
}