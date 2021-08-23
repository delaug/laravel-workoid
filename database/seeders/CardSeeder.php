<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Seeder;

class CardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Card::create(['name' => 'Analizing', 'sort' => 10, 'list_card_id'=>1]);
        Card::create(['name' => 'Coding', 'sort' => 20, 'list_card_id'=>1]);
        Card::create(['name' => 'Debuging', 'sort' => 10, 'list_card_id'=>3]);
        Card::create(['name' => 'Create project', 'sort' => 10, 'list_card_id'=>4]);

        Card::create(['name' => 'Base html', 'sort' => 10, 'list_card_id'=>5]);
        Card::create(['name' => 'Make images', 'sort' => 20, 'list_card_id'=>5]);
        Card::create(['name' => 'Draw icons', 'sort' => 30, 'list_card_id'=>5]);
        Card::create(['name' => 'References', 'sort' => 10, 'list_card_id'=>8]);
    }
}
