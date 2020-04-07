<?php


namespace Test\Unit\Articles;


use App\Content\Article;
use App\Content\Slideshow;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArticleBodyTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function parse_body_for_slideshows()
    {
        $en_body = <<<'EOT'
This is an English paragraph. 

[** sl:1:test-title **]

The final paragraph.
EOT;
        $zh_body = "nothing to see here";



        $article = factory(Article::class)->create([
            'body' => [
                'en' => $en_body, 'zh' => $zh_body,
            ]
        ]);
        $slideshow = factory(Slideshow::class)->create([
            'article_id' => $article->id,
            'title' => 'test title'
        ]);
        $slideshow_html = $slideshow->html();

        $expected_en_body = <<<EOD
This is an English paragraph. 

$slideshow_html

The final paragraph.
EOD;

        $this->assertEquals($expected_en_body, $article->parseBody('en'));
        $this->assertEquals($zh_body, $article->parseBody('zh'));
    }

    /**
     *@test
     */
    public function handles_multiple_slideshows()
    {
        $en_body = <<<'EOT'
This is an English paragraph. 

[** sl:1:test-title **]

This is a middle paragraph

[** sl:2:test-title **]

The final paragraph.
EOT;
        $zh_body = "nothing to see here";



        $article = factory(Article::class)->create([
            'body' => [
                'en' => $en_body, 'zh' => $zh_body,
            ]
        ]);
        $slideshowA = factory(Slideshow::class)->create([
            'article_id' => $article->id,
            'title' => 'test title'
        ]);
        $slideshowB = factory(Slideshow::class)->create([
            'article_id' => $article->id,
            'title' => 'test title B'
        ]);
        $slideshowA_html = $slideshowA->html();
        $slideshowB_html = $slideshowB->html();

        $expected_en_body = <<<EOD
This is an English paragraph. 

$slideshowA_html

This is a middle paragraph

$slideshowB_html

The final paragraph.
EOD;

        $this->assertEquals($expected_en_body, $article->parseBody('en'));
        $this->assertEquals($zh_body, $article->parseBody('zh'));
    }

    /**
     *@test
     */
    public function handles_non_existing_slideshows()
    {
        $en_body = <<<'EOT'
This is an English paragraph. 

[** sl:99:test-title **]

The final paragraph.
EOT;
        $zh_body = "nothing to see here";



        $article = factory(Article::class)->create([
            'body' => [
                'en' => $en_body, 'zh' => $zh_body,
            ]
        ]);


        $expected_en_body = <<<EOD
This is an English paragraph. 



The final paragraph.
EOD;

        $this->assertEquals($expected_en_body, $article->parseBody('en'));
        $this->assertEquals($zh_body, $article->parseBody('zh'));
    }
}