<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Group;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $director = Group::create([
            'name' => 'director',
            'display_name' => 'Directeur',
            'description' => 'Heeft volledige toegang tot het systeem',
            'requires_link' => false
        ]);

        $coordinator = Group::create([
            'name' => 'coordinator',
            'display_name' => 'Coördinator Bewaker',
            'description' => 'Beheert gevangenen en cellen',
            'requires_link' => false
        ]);

        $guard = Group::create([
            'name' => 'guard',
            'display_name' => 'Bewaker',
            'description' => 'Dagelijkse bewakingstaken',
            'requires_link' => false
        ]);

        // Assign permissions to roles
        $this->assignPermissions($director, [
            'prisoner_make', 'prisoner_edit', 'prisoner_delete',
            'cell_occupation_make', 'cell_occupation_edit', 'cell_occupation_delete'
        ]);

        $this->assignPermissions($coordinator, [
            'prisoner_make', 'prisoner_edit',
            'cell_occupation_make', 'cell_occupation_edit'
        ]);

        $this->assignPermissions($guard, [
            'prisoner_view' // Guards can only view prisoners
        ]);
    }

    private function assignPermissions(Group $group, array $permissions)
    {
        $actionIds = Action::whereIn('key', $permissions)->pluck('id');
        $group->actions()->sync($actionIds);
    }
}
