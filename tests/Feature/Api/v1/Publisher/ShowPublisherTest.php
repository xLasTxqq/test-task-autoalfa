<?php

namespace Tests\Feature\Api\v1\Publisher;

use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowPublisherTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_publisher_show_is_working()
    {
        $publisherCreated = Publisher::factory()->create();
        $response = $this->getJson("/api/v1/publisher/$publisherCreated->id");

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }
    public function test_route_publisher_show_is_not_working_with_false_id()
    {
        $response = $this->getJson("/api/v1/publisher/0");

        $response->assertStatus(404);
    }
}
