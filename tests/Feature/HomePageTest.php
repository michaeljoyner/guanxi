<?php


namespace Tests\Feature;


use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class HomePageTest extends TestCase
{

    use DatabaseMigrations;

    /**
     *@test
     */
    public function the_home_page_can_be_visited()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}