<?php

namespace Tests\Feature\Tags;

use App\Content\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteTagsTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function multiple_tags_can_be_deleted_by_a_super_admin()
    {
        $this->disableExceptionHandling();
        $this->asLoggedInUser();

        $to_be_deleted_tags = factory(Tag::class, 3)->create();
        $tags = factory(Tag::class, 4)->create();

        $response = $this->json("POST", '/admin/api/tags/delete', [
            'tags' => $to_be_deleted_tags->pluck('id')->all()
        ]);

        $response->assertStatus(200);

        $this->assertCount(4, Tag::all());

        $to_be_deleted_tags->each(function($tag) {
            $this->assertDatabaseMissing('tags', ['id' => $tag->id]);
        });

    }
}