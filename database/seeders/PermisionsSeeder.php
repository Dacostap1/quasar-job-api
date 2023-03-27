<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;


class PermisionsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    // Reset cached roles and permissions
    app()[PermissionRegistrar::class]->forgetCachedPermissions();

    // create permissions

    //Apply
    Permission::create(['name' => 'show:apply']);
    Permission::create(['name' => 'create:apply']);
    Permission::create(['name' => 'update:apply']);
    Permission::create(['name' => 'delete:apply']);

    //Jobs
    Permission::create(['name' => 'show:jobs']);
    Permission::create(['name' => 'create:jobs']);
    Permission::create(['name' => 'update:jobs']);
    Permission::create(['name' => 'delete:jobs']);


    // create roles and assign existing permissions
    $role1 = Role::create(['name' => 'applicant']);
    $role1->givePermissionTo('show:apply');
    $role1->givePermissionTo('create:apply');
    $role1->givePermissionTo('update:apply');
    $role1->givePermissionTo('delete:apply');


    $role2 = Role::create(['name' => 'admin']);
    $role2->givePermissionTo('show:jobs');
    $role2->givePermissionTo('create:jobs');
    $role2->givePermissionTo('update:jobs');
    $role2->givePermissionTo('delete:jobs');

    $role3 = Role::create(['name' => 'super-admin']);
    // gets all permissions via Gate::before rule; see AuthServiceProvider

    // create demo users
    $user = \App\Models\User::factory()->create([
      'name' => 'Postuante',
      'email' => 'postulante@example.com',
    ]);

    $user->assignRole($role1);

    $user = \App\Models\User::factory()->create([
      'name' => 'Example Admin User',
      'email' => 'admin@example.com',
    ]);

    $user->assignRole($role2);

    $user = \App\Models\User::factory()->create([
      'name' => 'Example Super-Admin User',
      'email' => 'superadmin@example.com',
    ]);

    $user->assignRole($role3);
  }
}
