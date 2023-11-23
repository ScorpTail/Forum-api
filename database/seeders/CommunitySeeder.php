<?php

namespace Database\Seeders;

use App\Models\Community;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['public', 'restricted', 'private'];

        Community::create([
            'user_id' => 1,
            'category_id' => 1,
            'name' => Str::random(10),
            'type' => $types[rand(0, 2)],
            'disclaimer' => rand(0, 1),
        ]);
    }
}
