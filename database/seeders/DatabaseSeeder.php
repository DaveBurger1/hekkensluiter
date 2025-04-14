<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Run role/permission seeder first
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Create test users for each role
        $users = [
            [
                'name' => 'Directeur Test',
                'email' => 'directeur@example.com',
                'password' => bcrypt('password'),
                'group' => 'director',
            ],
            [
                'name' => 'Coordinator Test',
                'email' => 'coordinator@example.com',
                'password' => bcrypt('password'),
                'group' => 'coordinator',
            ],
            [
                'name' => 'Jan de Vries',
                'email' => 'bewaker1@example.com',
                'password' => bcrypt('password'),
                'group' => 'guard',
            ],
            [
                'name' => 'Piet van Dijk',
                'email' => 'bewaker2@example.com',
                'password' => bcrypt('password'),
                'group' => 'guard',
            ],
            [
                'name' => 'Klaas van den Berg',
                'email' => 'bewaker3@example.com',
                'password' => bcrypt('password'),
                'group' => 'guard',
            ],
            [
                'name' => 'Henk Smit',
                'email' => 'bewaker4@example.com',
                'password' => bcrypt('password'),
                'group' => 'guard',
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create([
                'name' => $userData['name'],
                'email' => $userData['email'],
                'password' => $userData['password'],
            ]);
            $group = Group::where('name', $userData['group'])->first();
            if ($group) {
                $user->groups()->attach($group->id);
            }
        }
    }
}
