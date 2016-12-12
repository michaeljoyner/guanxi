<?php


use App\Media\Artwork;
use App\Media\HasMainImage;
use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ArtworksTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    protected $testAttributes = [
        'title' => 'Artfully named artwork',
        'zh_title' => 'Title in Chinese',
        'description' => 'Description of this striking piece',
        'zh_description' => 'As above but in Chinese'
    ];

    /**
     *@test
     */
    public function an_artwork_can_be_created_and_persisted()
    {
        $art = factory(Artwork::class)->create();

        $this->assertInstanceOf(Artwork::class, $art);
    }

    /**
     *@test
     */
    public function an_artwork_can_be_created_with_translations()
    {
        $artwork = Artwork::createWithTranslations($this->testAttributes);

        $this->assertModelHasAttributes($artwork, $this->testAttributes);
    }

    /**
     *@test
     */
    public function an_artwork_created_with_translations_can_be_attributed_to_a_profile()
    {
        $profile = factory(Profile::class)->create();

        $artwork = Artwork::createWithTranslations($this->testAttributes, $profile);

        $this->assertModelHasAttributes($artwork, $this->testAttributes);
        $this->assertEquals($artwork->contributor->id, $profile->id);
    }

    /**
     *@test
     */
    public function an_artwork_can_be_updated_with_translations()
    {
        $artwork = factory(Artwork::class)->create();

        $artwork->updateWithTranslations($this->testAttributes);
        $this->assertModelHasAttributes($artwork, $this->testAttributes);
    }

    /**
     *@test
     */
    public function a_main_image_can_be_set_for_the_artwork()
    {
        $artwork = factory(Artwork::class)->create();
        $artwork->setMainImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $artwork->getMedia());
        $artwork->clearMediaCollection();
    }

    /**
     *@test
     */
    public function an_artwork_has_a_default_main_image_src()
    {
        $artwork = factory(Artwork::class)->create();

        $this->assertEquals(Artwork::DEFAULT_IMG_SRC, $artwork->mainImageSrc());
    }

    protected function assertModelHasAttributes($model, $attributes)
    {
        collect($attributes)->each(function($attribute, $key) use ($model) {
           $locale = str_contains($key, 'zh_') ? 'zh' : 'en';
            $field = $locale === 'zh' ? substr($key, 3) : $key;
            $this->assertEquals($attribute, $model->getTranslation($field, $locale));
        });
    }


}