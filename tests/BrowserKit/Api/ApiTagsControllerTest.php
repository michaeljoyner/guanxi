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

    /**
     *@test
     */
    public function a_batch_of_tags_as_array_of_ids_are_correctly_deleted()
    {
        $this->asLoggedInUser();
        $tags = factory(Tag::class, 10)->create();
        $idsToDelete = $tags->pluck('id')->random(4);

        $this->delete('/admin/api/tags', ['tags' => $idsToDelete->toArray()])
            ->assertResponseOk();

        $idsToDelete->each(function($id) {
           $this->notSeeInDatabase('tags', ['id' => $id]);
        });
    }
}