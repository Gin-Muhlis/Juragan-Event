<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list addressevents']);
        Permission::create(['name' => 'view addressevents']);
        Permission::create(['name' => 'create addressevents']);
        Permission::create(['name' => 'update addressevents']);
        Permission::create(['name' => 'delete addressevents']);

        Permission::create(['name' => 'list cities']);
        Permission::create(['name' => 'view cities']);
        Permission::create(['name' => 'create cities']);
        Permission::create(['name' => 'update cities']);
        Permission::create(['name' => 'delete cities']);

        Permission::create(['name' => 'list refunds']);
        Permission::create(['name' => 'view refunds']);
        Permission::create(['name' => 'create refunds']);
        Permission::create(['name' => 'update refunds']);
        Permission::create(['name' => 'delete refunds']);

        Permission::create(['name' => 'list contacts']);
        Permission::create(['name' => 'view contacts']);
        Permission::create(['name' => 'create contacts']);
        Permission::create(['name' => 'update contacts']);
        Permission::create(['name' => 'delete contacts']);

        Permission::create(['name' => 'list events']);
        Permission::create(['name' => 'view events']);
        Permission::create(['name' => 'create events']);
        Permission::create(['name' => 'update events']);
        Permission::create(['name' => 'delete events']);

        Permission::create(['name' => 'list formats']);
        Permission::create(['name' => 'view formats']);
        Permission::create(['name' => 'create formats']);
        Permission::create(['name' => 'update formats']);
        Permission::create(['name' => 'delete formats']);

        Permission::create(['name' => 'list formatmixes']);
        Permission::create(['name' => 'view formatmixes']);
        Permission::create(['name' => 'create formatmixes']);
        Permission::create(['name' => 'update formatmixes']);
        Permission::create(['name' => 'delete formatmixes']);

        Permission::create(['name' => 'list allvisitors']);
        Permission::create(['name' => 'view allvisitors']);
        Permission::create(['name' => 'create allvisitors']);
        Permission::create(['name' => 'update allvisitors']);
        Permission::create(['name' => 'delete allvisitors']);

        Permission::create(['name' => 'list organizers']);
        Permission::create(['name' => 'view organizers']);
        Permission::create(['name' => 'create organizers']);
        Permission::create(['name' => 'update organizers']);
        Permission::create(['name' => 'delete organizers']);

        Permission::create(['name' => 'list partners']);
        Permission::create(['name' => 'view partners']);
        Permission::create(['name' => 'create partners']);
        Permission::create(['name' => 'update partners']);
        Permission::create(['name' => 'delete partners']);

        Permission::create(['name' => 'list payments']);
        Permission::create(['name' => 'view payments']);
        Permission::create(['name' => 'create payments']);
        Permission::create(['name' => 'update payments']);
        Permission::create(['name' => 'delete payments']);

        Permission::create(['name' => 'list posts']);
        Permission::create(['name' => 'view posts']);
        Permission::create(['name' => 'create posts']);
        Permission::create(['name' => 'update posts']);
        Permission::create(['name' => 'delete posts']);

        Permission::create(['name' => 'list tickets']);
        Permission::create(['name' => 'view tickets']);
        Permission::create(['name' => 'create tickets']);
        Permission::create(['name' => 'update tickets']);
        Permission::create(['name' => 'delete tickets']);

        Permission::create(['name' => 'list topics']);
        Permission::create(['name' => 'view topics']);
        Permission::create(['name' => 'create topics']);
        Permission::create(['name' => 'update topics']);
        Permission::create(['name' => 'delete topics']);

        Permission::create(['name' => 'list topicmixes']);
        Permission::create(['name' => 'view topicmixes']);
        Permission::create(['name' => 'create topicmixes']);
        Permission::create(['name' => 'update topicmixes']);
        Permission::create(['name' => 'delete topicmixes']);

        Permission::create(['name' => 'list transactiondetails']);
        Permission::create(['name' => 'view transactiondetails']);
        Permission::create(['name' => 'create transactiondetails']);
        Permission::create(['name' => 'update transactiondetails']);
        Permission::create(['name' => 'delete transactiondetails']);

        Permission::create(['name' => 'list alltransactionheaders']);
        Permission::create(['name' => 'view alltransactionheaders']);
        Permission::create(['name' => 'create alltransactionheaders']);
        Permission::create(['name' => 'update alltransactionheaders']);
        Permission::create(['name' => 'delete alltransactionheaders']);

        Permission::create(['name' => 'list galeries']);
        Permission::create(['name' => 'view galeries']);
        Permission::create(['name' => 'create galeries']);
        Permission::create(['name' => 'update galeries']);
        Permission::create(['name' => 'delete galeries']);

        Permission::create(['name' => 'list juragans']);
        Permission::create(['name' => 'view juragans']);
        Permission::create(['name' => 'create juragans']);
        Permission::create(['name' => 'update juragans']);
        Permission::create(['name' => 'delete juragans']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // create creator role and assign existion permissions
        $creatorRole = Role::create(['name' => 'creator']);
        $creatorRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // create role supper
        $superRole = Role::create(['name' => 'super']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admeen@admeen.com')->first();
        $creator = \App\Models\User::whereEmail('creator@creator.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
            $user->assignRole($superRole);
        }

        if ($creator) {
            $creator->assignRole($creatorRole);
            $user->assignRole($superRole);
        }
    }
}
