<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Enums\UserTypeEnum;
use App\Models\SubCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'type' => UserTypeEnum::Admin->value
        ]);

        Category::factory(15)->create();
        SubCategory::factory(15)->create();
    }
}
