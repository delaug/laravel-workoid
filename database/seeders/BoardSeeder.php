<?php

namespace Database\Seeders;

use App\Models\Board;
use Illuminate\Database\Seeder;

class BoardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Board::create(['name' => 'PHP Project', 'user_id' => 1]);
        Board::create(['name' => 'Figma design', 'user_id' => 2]);
        Board::create(['name' => 'Team work', 'user_id' => 1]);
    }
}
