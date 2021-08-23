<?php

namespace Database\Seeders;

use App\Models\ListCard;
use Illuminate\Database\Seeder;

class ListCardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ListCard::create(['name' => 'Planing', 'sort'=>10, 'board_id'=>1]);
        ListCard::create(['name' => 'In work', 'sort'=>20, 'board_id'=>1]);
        ListCard::create(['name' => 'Testing', 'sort'=>30, 'board_id'=>1]);
        ListCard::create(['name' => 'Done', 'sort'=>40, 'board_id'=>1]);
        ListCard::create(['name' => 'Bugs', 'sort'=>50, 'board_id'=>1]);
        ListCard::create(['name' => 'Features', 'sort'=>60, 'board_id'=>1]);

        ListCard::create(['name' => 'Disign', 'sort'=>10, 'board_id'=>2]);
        ListCard::create(['name' => 'In work', 'sort'=>20, 'board_id'=>2]);
        ListCard::create(['name' => 'Testing', 'sort'=>30, 'board_id'=>2]);
        ListCard::create(['name' => 'Done', 'sort'=>40, 'board_id'=>2]);
        ListCard::create(['name' => 'Repairs', 'sort'=>50, 'board_id'=>2]);
        ListCard::create(['name' => 'Inspiration', 'sort'=>60, 'board_id'=>2]);

        ListCard::create(['name' => 'Disign', 'sort'=>10, 'board_id'=>3]);
        ListCard::create(['name' => 'In work', 'sort'=>20, 'board_id'=>3]);
        ListCard::create(['name' => 'Testing', 'sort'=>30, 'board_id'=>3]);
        ListCard::create(['name' => 'Done', 'sort'=>40, 'board_id'=>3]);
        ListCard::create(['name' => 'Repairs', 'sort'=>50, 'board_id'=>3]);
        ListCard::create(['name' => 'Inspiration', 'sort'=>60, 'board_id'=>3]);
    }
}
