<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\UsersTableSeeder;
use Database\Seeders\EventsTableSeeder;
use Database\Seeders\AttendeesTableSeeder;
use Database\Seeders\BookingsTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            EventsTableSeeder::class,
            AttendeesTableSeeder::class,
            BookingsTableSeeder::class,
        ]);
    }
}
