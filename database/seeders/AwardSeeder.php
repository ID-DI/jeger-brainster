<?php

namespace Database\Seeders;

use App\Models\Award;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hats = new Award();
        $hats->type = 'hat';
        $hats->quantity = 5;
        $hats->save();

        $tShirt = new Award();
        $tShirt->type = 'T-shirt';
        $tShirt->quantity = 3;
        $tShirt->save();

        $glasess = new Award();
        $glasess->type = 'glasess';
        $glasess->quantity = 1;
        $glasess->save();

    }
}
