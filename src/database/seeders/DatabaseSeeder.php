<?php

namespace Database\Seeders;

use App\Models\Ability;
use App\Models\Category;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        $test = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $role_admin = Role::create(['name' => 'Admin']);
        $role_test = Role::create(['name' => 'Test']);

        $ability_module_user = Ability::create(['name' => 'module_user']);
        $ability_module_category = Ability::create(['name' => 'module_category']);
        $ability_module_product = Ability::create(['name' => 'module_product']);

        $admin->roles()->sync([$role_admin->id]);
        $test->roles()->sync([$role_test->id]);

        $role_admin->abilities()->sync([$ability_module_user->id, $ability_module_category->id, $ability_module_product->id]);
        $role_test->abilities()->sync([$ability_module_category->id, $ability_module_product->id]);

        Category::create(['name' => 'Category 1']);
        Category::create(['name' => 'Category 2']);
        Category::create(['name' => 'Category 3']);
    }
}
