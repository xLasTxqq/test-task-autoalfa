<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::truncate();

        Status::create(['name' => Status::BOOKED_STATUS_NAME]);
        Status::create(['name' => Status::TAKEN_STATUS_NAME]);
    }
}
