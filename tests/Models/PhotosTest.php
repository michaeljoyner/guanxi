<?php


use App\Media\Photo;
use App\People\Profile;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PhotosTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    protected $testAttributes = [
        'title' => 'Artfully named photo',
        'zh_title' => 'Title in Chinese',
        'description' => 'Description of image or gallery',
        'zh_description' => 'As above but in Chinese'
    ];

    /**
     *@test
     */
    public function a_photo_can_be_created_and_persisted()
    {
        $gallery = factory(Photo::class)->create();

        $this->assertInstanceOf(Photo::class, $gallery);
    }

    /**
     *@test
     */
    public function a_photo_can_be_created_with_translations()
    {
        $gallery = Photo::createWithTranslations($this->testAttributes);

        $this->assertModelHasTestAttributes($gallery);
    }

    /**
     *@test
     */
    public function a_photo_can_be_created_with_a_profile_to_be_the_contributor()
    {
        $profile = factory(Profile::class)->create();
        $photo = Photo::createWithTranslations($this->testAttributes, $profile);

        $this->assertModelHasTestAttributes($photo);
        $this->assertEquals($photo->profile_id, $profile->id);
        $this->assertEquals($photo->contributor->id, $profile->id);
    }

    /**
     *@test
     */
    public function a_photo_can_be_updated_with_translations()
    {
        $photo = factory(Photo::class)->create();
        $originalTitle = $photo->getTranslation('title', 'en');
        $originalDesrciption = $photo->getTranslation('description', 'en');

        $photo->updateWithTranslations(['zh_title' => 'Chinese new name', 'zh_description' => 'New chinese description']);

        $this->seeInDatabase('photos', [
            'id' => $photo->id,
            'profile_id' => $photo->profile_id,
            'title' => json_encode(['en' => $originalTitle, 'zh' => 'Chinese new name']),
            'description' => json_encode(['en' => $originalDesrciption, 'zh' => 'New chinese description']),
            'published' => $photo->published ? 1 : 0
        ]);
    }

    /**
     *@test
     */
    public function a_main_image_can_be_attached_to_the_photo()
    {
        $photo = factory(Photo::class)->create();

        $photo->setMainImage($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $photo->getMedia());

        $photo->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_photo_has_a_default_main_image_src()
    {
        $photo = factory(Photo::class)->create();

        $this->assertEquals(Photo::DEFAULT_IMG_SRC, $photo->mainImageSrc());
    }

    protected function assertModelHasTestAttributes($photo)
    {
        $this->assertInstanceOf(Photo::class, $photo);
        $this->assertEquals('Artfully named photo', $photo->getTranslation('title', 'en'));
        $this->assertEquals('Title in Chinese', $photo->getTranslation('title', 'zh'));
        $this->assertEquals('Description of image or gallery', $photo->getTranslation('description', 'en'));
        $this->assertEquals('As above but in Chinese', $photo->getTranslation('description', 'zh'));
    }
}