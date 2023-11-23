<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\PostSeeder;
use Database\Seeders\RoleSeeder;
use Database\Seeders\CommunitySeeder;
use Database\Seeders\PermissionSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'role_id' => Role::ADMIN_ID,
            'name' => 'Admin',
            'nickName' => 'AdminNickName',
            'email' => 'admin@gmail.com',
            'password' => 'Password123', //Password123
            'about' => fake()->text(),
        ]);

        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            PostSeeder::class,
            CommunitySeeder::class,
        ]);
    }
}
