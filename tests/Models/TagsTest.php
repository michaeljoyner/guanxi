<?php


use App\Content\Tag;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function tags_are_a_thing()
    {
        $tag = factory(Tag::class)->create();

        $this->assertInstanceOf(App\Content\Tag::class, $tag);
    }

    /**
     *@test
     */
    public function a_group_of_tags_may_be_deleted()
    {
        $tags = factory(Tag::class, 10)->create();
        $idsToRemove = $tags->pluck('id')->random(4);

        Tag::deleteBatch($idsToRemove->toArray());

        $this->assertCount(6, Tag::all());

        $idsToRemove->each(function($id) {
            $this->notSeeInDatabase('tags', ['id' => $id]);
        });
    }

    /**
     *@test
     */
    public function a_tag_has_a_slug()
    {
        $tag = factory(Tag::class)->create(['name' => 'has slug']);

        $this->assertEquals('has-slug', $tag->fresh()->slug);

    }


}