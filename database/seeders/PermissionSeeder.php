<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'editing.post']); // редагувати пости
        Permission::create(['name' => 'editing.comments']); // редагувати пости
        Permission::create(['name' => 'written.post']); //писати пости
        Permission::create(['name' => 'written.comments']); //писати коментарі
        Permission::create(['name' => 'reading']); //читати пости
        Permission::create(['name' => 'reading.comments']); //читати пости
        Permission::create(['name' => 'deleting.post']); // видаляти пости
        Permission::create(['name' => 'deleting.comments']); // видаляти коментарі
    }
}
