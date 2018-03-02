<?php


use App\Affiliates\Affiliate;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AffiliateImageControllerTest extends BrowserKitTestCase
{
    use DatabaseMigrations, TestsImageUploads;

    /**
     *@test
     */
    public function an_uploaded_image_is_properly_stored_on_the_affiliate()
    {
        $this->disableExceptionHandling();
        $this->asLoggedInUser();
        $affiliate = factory(Affiliate::class)->create();

        $response = $this->call('POST', '/admin/affiliates/' . $affiliate->id . '/image', [], [], [
            'file' => $this->prepareFileUpload('tests/testpic1.png')
        ]);
        $this->assertEquals(200, $response->status());

        $this->assertCount(1, $affiliate->getMedia());

        $affiliate->clearMediaCollection();
    }
}