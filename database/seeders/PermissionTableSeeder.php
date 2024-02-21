<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'home-list',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',
            'permission-status',

            'notification-list',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'role-status',
 
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'user-status',
 
            'about-list',
            'about-create',
            'about-edit',
            'about-delete',
            'about-status',
 
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'category-status',
 
            'contact-list',
            'contact-create',
            'contact-edit',
            'contact-delete',
            'contact-status',
 
            'favorite-list',
            'favorite-create',
            'favorite-edit',
            'favorite-delete',
            'favorite-status',
 
            'meta-list',
            'meta-create',
            'meta-edit',
            'meta-delete',
            'meta-status',
 
            'post-list',
            'post-create',
            'post-edit',
            'post-delete',
            'post-status',
 
            'social-list',
            'social-create',
            'social-edit',
            'social-delete',
            'social-status',
 
            'tag-list',
            'tag-create',
            'tag-edit',
            'tag-delete',
            'tag-status',
 
            'theme-list',
            'theme-create',
            'theme-edit',
            'theme-delete',
            'theme-status',
 
            'subscription-list',
            'subscription-create',
            'subscription-edit',
            'subscription-delete',
            'subscription-status',
        ];
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}
