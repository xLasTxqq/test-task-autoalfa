<?php

namespace Tests\Feature\Api\v1\Publisher;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class IndexPublisherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_publisher_index_is_working()
    {
        $response = $this->getJson('/api/v1/publisher');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
}
