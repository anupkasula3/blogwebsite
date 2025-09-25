<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            [ 'email' => 'test@example.com' ],
            [
                'name' => 'Default Admin',
                'password' => 'password', // Will be hashed by model mutator
            ]
        );
    }
}
