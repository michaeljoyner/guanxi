<?php


use App\Pages\AboutPage;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AboutPageTest extends BrowserKitTestCase
{
    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_page_does_not_need_to_be_created_before_a_section_is_set()
    {
        $story = [
            'en' => 'Once upon a time there was a magazine',
            'zh' => '雌姿凹淤恩'
        ];
        AboutPage::setStory($story);

        $this->app->setLocale('en');
        $this->assertEquals('Once upon a time there was a magazine', AboutPage::story());
        $this->app->setLocale('zh');
        $this->assertEquals('雌姿凹淤恩', AboutPage::story());
        $this->assertEquals($story, AboutPage::story(true));
    }

    /**
     *@test
     */
    public function the_marketing_content_can_be_set_and_retrieved()
    {
        $content = [
            'en' => 'We love marketing',
            'zh' => '誒痾瘀誒恩'
        ];

        AboutPage::setMarketing($content);
        $this->app->setLocale('en');
        $this->assertEquals('We love marketing', AboutPage::marketing());
        $this->app->setLocale('zh');
        $this->assertEquals('誒痾瘀誒恩', AboutPage::marketing());
        $this->assertEquals($content, AboutPage::marketing(true));
    }

    /**
     *@test
     */
    public function the_events_content_can_be_set_and_retrieved()
    {
        $content = [
            'en' => 'We love events',
            'zh' => '誒痾瘀屋ㄖㄠ'
        ];

        AboutPage::setEvents($content);
        $this->app->setLocale('en');
        $this->assertEquals('We love events', AboutPage::eventsText());
        $this->app->setLocale('zh');
        $this->assertEquals('誒痾瘀屋ㄖㄠ', AboutPage::eventsText());
        $this->assertEquals($content, AboutPage::eventsText(true));
    }

    /**
     *@test
     */
    public function the_contribute_section_content_can_be_set_and_retrieved()
    {
        $content = [
            'en' => 'We love contributions',
            'zh' => '誒痾瘀雌喔茲瘀'
        ];

        AboutPage::setContribute($content);
        $this->app->setLocale('en');
        $this->assertEquals('We love contributions', AboutPage::contribute());
        $this->app->setLocale('zh');
        $this->assertEquals('誒痾瘀雌喔茲瘀', AboutPage::contribute());
        $this->assertEquals($content, AboutPage::contribute(true));
    }

    /**
     *@test
     */
    public function the_contact_section_content_can_be_set_and_retrieved()
    {
        $content = [
            'en' => 'Reach out and touch us',
            'zh' => '誒痾瘀誒瘀凹茲'
        ];

        AboutPage::setContact($content);
        $this->app->setLocale('en');
        $this->assertEquals('Reach out and touch us', AboutPage::contact());
        $this->app->setLocale('zh');
        $this->assertEquals('誒痾瘀誒瘀凹茲', AboutPage::contact());
        $this->assertEquals($content, AboutPage::contact(true));
    }

    /**
     *@test
     */
    public function all_the_page_content_can_be_retrieved_for_the_set_locale()
    {
        $this->setUpPageWithContent();

        $result = AboutPage::getContent();

        $this->assertInstanceOf(AboutPage::class, $result['page']);

        $this->assertEquals('Once upon a time there was a magazine', $result['page']->story);
    }

    protected function setUpPageWithContent()
    {
        AboutPage::setStory([
            'en' => 'Once upon a time there was a magazine',
            'zh' => '雌姿凹淤恩'
        ]);
        AboutPage::setMarketing([
            'en' => 'We love marketing',
            'zh' => '誒痾瘀誒恩'
        ]);
        AboutPage::setEvents([
            'en' => 'We love events',
            'zh' => '誒痾瘀屋ㄖㄠ'
        ]);
        AboutPage::setContribute([
            'en' => 'We love contributions',
            'zh' => '誒痾瘀雌喔茲瘀'
        ]);
        AboutPage::setContact([
            'en' => 'Reach out and touch us',
            'zh' => '誒痾瘀誒瘀凹茲'
        ]);
    }
}