<?php

namespace Tests\Unit\Media;

use App\Media\Artwork;
use App\People\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NullContributorTest extends TestCase
{
    use RefreshDatabase;

    /**
     *@test
     */
    public function an_artwork_with_a_null_profile_id_has_a_null_contributor()
    {
        $artwork = factory(Artwork::class)->create(['profile_id' => null]);

        $this->assertInstanceOf(Profile::class, $artwork->contributor);
        $this->assertEquals('', $artwork->contributor->name);
        $this->assertEquals(Profile::DEFAULT_AVATAR_SRC, $artwork->contributor->avatar('thumb'));
        $this->assertEquals('', $artwork->contributor->getTranslation('intro', 'en'));
    }
}