<?php

namespace Database\Seeders;

use App\Models\Fishlogs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FishlogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Fishlogs::factory()->count(30)->create();
    }
}
