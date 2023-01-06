<?php

namespace Tests\Feature\Api\v1\Book;

use App\Jobs\SendMailAboutBookJob;
use App\Listeners\FreeBookEmailNotification;
use App\Mail\NotificationSubscribedBookForm;
use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use Mockery\MockInterface;
use Tests\TestCase;

class BookRoutesTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_route_book_index_is_working()
    {
        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/api/v1/book');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_book_create_is_working()
    {

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->postJson('/api/v1/book', Book::factory()->create()->toArray());

        $response->assertStatus(200)
            ->assertJson(fn (AssertableJson $json) => $json->has('data'));
    }

    public function test_route_book_show_is_working()
    {
        $book = Book::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->getJson('/api/v1/book/' . $book->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $book->id)
            ->assertJsonPath('data.name', $book->name);
    }

    public function test_route_book_update_is_working()
    {
        $book = Book::factory()->create();

        Sanctum::actingAs(
            User::factory()->create(),
            ['*']
        );

        $response = $this->putJson('/api/v1/book/' . $book->id, $book->toArray());

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $book->id)
            ->assertJsonPath('data.name', $book->name);
    }

    public function test_route_book_destroy_is_working()
    {
        Mail::fake();
        $book = Book::factory()->create();
        $user = User::factory()->create();
        Sanctum::actingAs(
            $user,
            ['*']
        );

        // $mail=$this->createMock(FreeBookEmailNotification::class);
        // $mail->expects($this->once());
        // $mail = $this->createMock(Mail::class);
        // $mail->expects($this->once())->method('send');

        $response = $this->deleteJson('/api/v1/book/' . $book->id);

        $response->assertStatus(200)
            ->assertJsonPath('data.id', $book->id)
            ->assertJsonPath('data.name', $book->name);

        // Mail::assertSent(NotificationSubscribedBookForm::class, function ($mail) use ($user) {
        //     return $mail->hasTo($user->email);
        // });
    }

    public function test_route_book_index_is_working_without_auth()
    {
        $response = $this->getJson('/api/v1/book');

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => []]);
    }

    public function test_route_book_create_is_not_working_without_auth()
    {

        $response = $this->postJson('/api/v1/book', Book::factory()->create()->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_book_show_is_not_working_without_auth()
    {
        $response = $this->getJson('/api/v1/book/1');

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_book_update_is_not_working_without_auth()
    {
        $book = Book::factory()->create();

        $response = $this->putJson('/api/v1/book/' . $book->id, $book->toArray());

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }

    public function test_route_book_destroy_is_not_working_without_auth()
    {
        $book = Book::factory()->create();
        $response = $this->deleteJson('/api/v1/book/' . $book->id);

        $response->assertStatus(401)
            ->assertExactJson(['message' => "Unauthenticated."]);
    }
}
