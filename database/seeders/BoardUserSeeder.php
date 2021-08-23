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
        $user = User::find(1);
        $user->boards()->attach(Role::IS_ADMIN);

        $user = User::find(2);
        $user->boards()->attach(Role::IS_USER);
    }
}
