<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Action>
 */
class ActionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $statuses = Status::STATUSES;
        return [
            'user_id' => User::factory(),
            'book_id' => Book::factory(),
            'status_id' => Status::whereIn('id', $statuses)->count() == count($statuses) ?
                $statuses[array_rand($statuses)] : Status::factory()
        ];
    }
}
