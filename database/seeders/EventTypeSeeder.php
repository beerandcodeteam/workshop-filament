<?php

namespace Database\Seeders;

use App\Models\EventType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => 'Show'],
            ['name' => 'Palestra'],
            ['name' => 'Teatro'],
            ['name' => 'Encontro'],
        ];

        EventType::insert($data);
    }
}
