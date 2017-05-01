<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class PagesTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function an_orphaned_article_should_not_cause_an_exception_on_the_home_page()
    {
        //create article with non existent profile
        $this->assertNull(\App\People\Profile::find(7));
        factory(\App\Content\Article::class)->create(['profile_id' => 7, 'published' => true]);

        $this->get('/')->assertResponseOk();
    }
}