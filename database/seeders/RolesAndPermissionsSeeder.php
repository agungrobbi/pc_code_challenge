<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // --- 1. Create Permissions ---

        $permissions = [
            // Permissions for Categories
            'view category',
            'create category',
            'update category',
            'delete category',

            // Permissions for Posts
            'view post',
            'create post',
            'update post',
            'delete post',

            // Permissions for Pages
            'view page',
            'create page',
            'update page',
            'delete page',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission);
        }

        // --- 2. Create Roles and Assign Permissions ---
        // Role: Admin (has all permissions)
        $adminRole = Role::findOrCreate('Admin');
        $adminRole->givePermissionTo(Permission::all()); // Assign all existing permissions to Admin

        // Role: Post Editor
        $postEditorRole = Role::findOrCreate('Post Editor');
        $postEditorRole->givePermissionTo([
            'view post',
            'create post',
            'update post',
        ]);

        // Role: Page Editor
        $pageEditorRole = Role::findOrCreate('Page Editor');
        $pageEditorRole->givePermissionTo([
            'view page',
            'create page',
            'update page',
        ]);


        // --- 3. Assign Role to a User (Optional but Recommended) ---
        // Find an existing user (e.g., user with ID 1) or create a new one.
        // Make sure to replace 'your@admin.com' and 'password' with actual credentials.
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin User',
                'password' => bcrypt('password'),
            ]
        );

        if (!$adminUser->hasRole('Admin')) {
            $adminUser->assignRole('Admin');
        }

        $postEditorUser = User::firstOrCreate(
            ['email' => 'posteditor@gmail.com'],
            [
                'name' => 'Post Editor User',
                'password' => bcrypt('password'),
            ]
        );
        if (!$postEditorUser->hasRole('Post Editor')) {
            $postEditorUser->assignRole('Post Editor');
        }

        $pageEditorUser = User::firstOrCreate(
            ['email' => 'pageeditor@gmail.com'],
            [
                'name' => 'Page Editor User',
                'password' => bcrypt('password'),
            ]
        );
        if (!$pageEditorUser->hasRole('Page Editor')) {
            $pageEditorUser->assignRole('Page Editor');
        }
    }
}
