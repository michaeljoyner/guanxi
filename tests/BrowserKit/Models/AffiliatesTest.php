<?php


use App\Affiliates\Affiliate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AffiliatesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function affiliates_exists()
    {
        $affiliate = factory(Affiliate::class)->create();

        $this->assertInstanceOf(Affiliate::class, $affiliate);
    }

    /**
     *@test
     */
    public function an_affiliate_may_be_created_with_translations()
    {
        $data = [
            'name' => 'The Frog',
            'location' => '123 Sesame Str',
            'zh_location' => 'Yi bai er shi san sesame lu',
            'writeup' => 'Cool place, nice mexiacn food',
            'zh_writeup' => 'Wo xihuan zhege difang',
            'website' => 'http://frog.tw'
        ];

        $affiliate = Affiliate::createWithTranslations($data);

        $this->assertInstanceOf(Affiliate::class, $affiliate);
        $this->assertEquals('123 Sesame Str', $affiliate->getTranslation('location', 'en'));
        $this->assertEquals('Yi bai er shi san sesame lu', $affiliate->getTranslation('location', 'zh'));
        $this->assertEquals('Cool place, nice mexiacn food', $affiliate->getTranslation('writeup', 'en'));
        $this->assertEquals('Wo xihuan zhege difang', $affiliate->getTranslation('writeup', 'zh'));
        $this->assertEquals('The Frog', $affiliate->name);
        $this->assertEquals('http://frog.tw', $affiliate->website);
    }

    /**
     *@test
     */
    public function an_affiliate_can_be_updated_with_translations()
    {
        $affiliate = factory(Affiliate::class)->create();
        $originalData = $affiliate->toArray();
        $data = [
            'name' => 'The Frog',
            'location' => '123 Sesame Str',
            'zh_location' => 'Yi bai er shi san sesame lu',
            'writeup' => 'Cool place, nice mexiacn food',
            'zh_writeup' => 'Wo xihuan zhege difang',
        ];

        $affiliate->updateWithTranslations($data);

        $this->assertEquals('123 Sesame Str', $affiliate->getTranslation('location', 'en'));
        $this->assertEquals('Yi bai er shi san sesame lu', $affiliate->getTranslation('location', 'zh'));
        $this->assertEquals('Cool place, nice mexiacn food', $affiliate->getTranslation('writeup', 'en'));
        $this->assertEquals('Wo xihuan zhege difang', $affiliate->getTranslation('writeup', 'zh'));
        $this->assertEquals('The Frog', $affiliate->name);
        $this->assertEquals($originalData['website'], $affiliate->website);
        $this->assertEquals($originalData['phone'], $affiliate->phone);
    }

    /**
     *@test
     */
    public function an_affiliate_can_have_an_image_attached_to_it()
    {
        $affiliate = factory(Affiliate::class)->create();

        $affiliate->setImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $affiliate->getMedia());

        $affiliate->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_new_affiliate_has_a_default_image_src()
    {
        $affiliate = factory(Affiliate::class)->create();

        $this->assertEquals(Affiliate::DEFAULT_IMAGE_SRC, $affiliate->imageSrc());
    }

    /**
     *@test
     */
    public function an_affiliate_can_be_published()
    {
        $affiliate = factory(Affiliate::class)->create(['published' => false]);

        $affiliate->publish();

        $this->assertTrue($affiliate->published);
    }

    /**
     *@test
     */
    public function an_affiliate_can_be_retracted()
    {
        $affiliate = factory(Affiliate::class)->create(['published' => true]);

        $affiliate->retract();

        $this->assertFalse($affiliate->published);
    }
}