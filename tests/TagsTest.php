<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class TagsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function tags_are_a_thing()
    {
        $tag = factory(App\Content\Tag::class)->create();

        $this->assertInstanceOf(App\Content\Tag::class, $tag);
    }
}