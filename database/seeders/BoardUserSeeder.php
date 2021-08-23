<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class BoardUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);
        $user = User::find(2);

        // Admin
        $admin->boards()->attach(1);
        // User
        $user->boards()->attach(2);
        // Team
        $admin->boards()->attach(3);
        $user->boards()->attach(3);
    }
}
