<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class ApiArticlePagesControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function the_correct_articles_are_returned()
    {
        $this->disableExceptionHandling();
//        $category = factory(\App\Content\Category::class)->create();
        foreach(range(1,20) as $item) {
            factory(\App\Content\Article::class)->create([
                'title' => [
                    'en' => 'Title number ' . $item,
                    'zh' => 'Zh title ' . $item
                ],
                'published' => true,
            ]);
        }

        $this->get('/api/content/articles?page=2')
            ->assertResponseOk()
            ->seeJson(['page' => 2, 'remaining' => true])
            ->seeJsonStructure(['content_html']);

        $html = json_decode($this->response->getContent(), true)['content_html'];

        foreach(range(10,18) as $item) {
            $this->assertStringContainsString('Title number ' . $item, $html);
        }
    }

    /**
     *@test
     */
    public function the_correct_values_for_page_and_remaining_are_returned()
    {
        foreach(range(1,24) as $item) {
            factory(\App\Content\Article::class)->create([
                'title' => [
                    'en' => 'Title number ' . $item,
                    'zh' => 'Zh title ' . $item
                ],
                'published' => true,
            ]);
        }

        $this->get('/api/content/articles?page=3')
            ->assertResponseOk()
            ->seeJson(['page' => 3, 'remaining' => false])
            ->seeJsonStructure(['content_html']);

        $html = json_decode($this->response->getContent(), true)['content_html'];

        foreach(range(19,24) as $item) {
            $this->assertStringContainsString('Title number ' . $item, $html);
        }
    }
}