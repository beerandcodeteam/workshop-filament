<?php

namespace Database\Seeders;

use App\Models\AttractionType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttractionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['name' => "Banda"],
            ['name' => "Influencer"],
            ['name' => "Coach"],
            ['name' => "Celebridade"],
        ];

        AttractionType::insert($data);
    }
}
