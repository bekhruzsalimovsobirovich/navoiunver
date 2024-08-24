<?php

namespace Database\Seeders;

use App\Domain\Admin\Controls\Models\Control;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ControlSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Control::create([
            'name' => 'Axborot xavfsizligi'
        ]);

        Control::create([
            'name' => 'Python dasturlash tili'
        ]);
    }
}
