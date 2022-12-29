<?php

namespace Tests\Feature\Api\V1;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_api_v1_create_book_route_work()
    {
        $response = $this->post(route('api.v1.book.create'));
        $response->assertStatus(200);
    }
}
