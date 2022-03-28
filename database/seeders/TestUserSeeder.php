<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->times(3)
            ->withPersonalTeam()
            ->sequence(fn($sequence) => ['email' => sprintf('user%s@gogolink.local', $sequence->index)])
            ->create();
    }
}
