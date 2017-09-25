<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class AboutPageControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function the_story_content_is_properly_set()
    {
        $content = [
            'story'    => 'This is our story',
            'zh_story' => '痾誒茲咿嗚'
        ];
        $this->asLoggedInUser();

        $this->post('/admin/pages/about/story', $content)->assertResponseStatus(302)
             ->seeInDatabase('about_pages', [
                 'story' => \GuzzleHttp\json_encode([
                     'en' => 'This is our story',
                     'zh' => '痾誒茲咿嗚'
                 ])
             ]);
    }

    /**
     * @test
     */
    public function the_marketing_content_is_properly_set()
    {
        $content = [
            'marketing'    => 'We be marketing',
            'zh_marketing' => '痾誒茲咿嗚'
        ];
        $this->asLoggedInUser();

        $this->post('/admin/pages/about/marketing', $content)->assertResponseStatus(302)
             ->seeInDatabase('about_pages', [
                 'marketing' => \GuzzleHttp\json_encode([
                     'en' => 'We be marketing',
                     'zh' => '痾誒茲咿嗚'
                 ])
             ]);
    }

    /**
     * @test
     */
    public function the_events_content_is_properly_set()
    {
        $content = [
            'events_text'    => 'We be eventing',
            'zh_events_text' => '痾誒茲咿嗚'
        ];
        $this->asLoggedInUser();

        $this->post('/admin/pages/about/events', $content)->assertResponseStatus(302)
             ->seeInDatabase('about_pages', [
                 'events_text' => \GuzzleHttp\json_encode([
                     'en' => 'We be eventing',
                     'zh' => '痾誒茲咿嗚'
                 ])
             ]);

    }

    /**
     * @test
     */
    public function the_contribute_content_is_properly_set()
    {
        $content = [
            'contribute'    => 'We be contributing',
            'zh_contribute' => '痾誒茲咿嗚'
        ];
        $this->asLoggedInUser();

        $this->post('/admin/pages/about/contribute', $content)->assertResponseStatus(302)
             ->seeInDatabase('about_pages', [
                 'contribute' => \GuzzleHttp\json_encode([
                     'en' => 'We be contributing',
                     'zh' => '痾誒茲咿嗚'
                 ])
             ]);
    }

    /**
     * @test
     */
    public function the_contact_content_is_properly_set()
    {
        $content = [
            'contact'    => 'We be contacting',
            'zh_contact' => '痾誒茲咿嗚'
        ];
        $this->asLoggedInUser();

        $this->post('/admin/pages/about/contact', $content)->assertResponseStatus(302)
             ->seeInDatabase('about_pages', [
                 'contact' => \GuzzleHttp\json_encode([
                     'en' => 'We be contacting',
                     'zh' => '痾誒茲咿嗚'
                 ])
             ]);
    }
}