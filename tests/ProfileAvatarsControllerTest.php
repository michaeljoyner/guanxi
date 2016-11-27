<?php


use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileAvatarsControllerTest extends TestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_uploaded_image_is_stored_on_the_profile()
    {
        $profile = $this->asLoggedInUser()->profile;

        $response = $this->call('POST', '/admin/profiles/' . $profile->id . '/avatar', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $profile->getMedia());

        $profile->clearMediaCollection();
    }
}