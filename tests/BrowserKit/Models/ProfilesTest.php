<?php


use App\People\Profile;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfilesTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function profiles_are_a_thang()
    {
        $profile = factory(Profile::class)->create();

        $this->assertInstanceOf(Profile::class, $profile);
    }

    /**
     *@test
     */
    public function a_profile_can_be_updated_with_translations()
    {
        $profile = factory(Profile::class)->create();

        $profile->updateWithTranslations([
            'name' => 'New Name',
            'title' => 'Contributor',
            'zh_title' => 'Xie Ren',
            'intro' => 'The one, the only',
            'zh_intro' => 'De yige ren',
        ]);

        $this->assertEquals('New Name', $profile->name);
        $this->assertEquals('Contributor', $profile->getTranslation('title', 'en'));
        $this->assertEquals('Xie Ren', $profile->getTranslation('title', 'zh'));
        $this->assertEquals('The one, the only', $profile->getTranslation('intro', 'en'));
        $this->assertEquals('De yige ren', $profile->getTranslation('intro', 'zh'));
    }

    /**
     *@test
     */
    public function a_profile_can_have_an_avatar()
    {
        $profile = factory(Profile::class)->create();

        $profile->setAvatar($this->prepareFileUpload('tests/testpic1.png'));

        $this->assertCount(1, $profile->getMedia());

        $profile->clearMediaCollection();
    }

    /**
     *@test
     */
    public function a_new_profile_has_a_default_avatar()
    {
        $profile = factory(Profile::class)->create();

        $this->assertEquals(Profile::DEFAULT_AVATAR_SRC, $profile->avatar());
    }

    /**
     *@test
     */
    public function a_profile_can_be_published()
    {
        $profile = factory(Profile::class)->create();
        $this->assertFalse($profile->published);

        $profile->publish();
        $this->assertTrue($profile->published);
    }

    /**
     *@test
     */
    public function a_published_profile_can_be_retracted()
    {
        $profile = factory(Profile::class)->create();
        $profile->publish();
        $this->assertTrue($profile->published);

        $profile->retract();
        $this->assertFalse($profile->published);
    }



    /**
     *@test
     */
    public function a_profile_can_be_created_with_translations_and_not_belonging_to_a_user()
    {
        $profile = Profile::createWithTranslations([
            'name' => 'Mister Donut',
            'title' => 'Stratergist',
            'zh_title' => 'Xiang ren',
            'intro' => 'I am a donut',
            'zh_intro' => 'Wo shi ling dan',
            'bio' => '',
            'zh_bio' => ''
        ]);

        $this->assertNull($profile->user);
        $this->assertInstanceOf(Profile::class, $profile);
        $this->assertEquals('Mister Donut', $profile->name);
        $this->assertEquals('Stratergist', $profile->getTranslation('title', 'en'));
        $this->assertEquals('Xiang ren', $profile->getTranslation('title', 'zh'));
        $this->assertEquals('I am a donut', $profile->getTranslation('intro', 'en'));
        $this->assertEquals('Wo shi ling dan', $profile->getTranslation('intro', 'zh'));
        $this->assertEquals('', $profile->getTranslation('bio', 'en'));
        $this->assertEquals('', $profile->getTranslation('bio', 'zh'));
    }

    /**
     *@test
     */
    public function a_profile_can_be_assigned_to_a_user()
    {
        $profile = factory(Profile::class)->create(['user_id' => null]);
        $user = factory(User::class)->create();

        $profile->assignTo($user);

        $this->assertEquals($profile->fresh()->user_id, $user->id);
    }

    /**
     *@test
     */
    public function a_profile_knows_if_it_has_a_user()
    {
        $non_user = factory(Profile::class)->create(['user_id' => null]);
        $user_profile = factory(User::class)->create()->createProfile();

        $this->assertTrue($user_profile->hasUser());
        $this->assertFalse($non_user->hasUser());
    }
}