<?php

namespace Tests\Feature;


use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContributorForbiddenTest extends TestCase
{
    use RefreshDatabase;
    /**
     *@test
     */
    public function a_contributor_is_redirected_to_admin_page_if_request_is_forbidden()
    {
        $request = $this->asLoggedInContributor()->get('/admin/users');

        $request->assertRedirect('/admin');
    }
}