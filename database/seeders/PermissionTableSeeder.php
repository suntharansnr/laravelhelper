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

           'city-list',
           'city-create',
           'city-edit',
           'city-delete',
           'city-status',

           'contact-list',
           'contact-create',
           'contact-edit',
           'contact-delete',
           'contact-status',

           'continent-list',
           'continent-create',
           'continent-edit',
           'continent-delete',
           'continent-status',

           'country-list',
           'country-create',
           'country-edit',
           'country-delete',
           'country-status',

           'faq-list',
           'faq-create',
           'faq-edit',
           'faq-delete',
           'faq-status',

           'favorite-list',
           'favorite-create',
           'favorite-edit',
           'favorite-delete',
           'favorite-status',

           'genre-list',
           'genre-create',
           'genre-edit',
           'genre-delete',
           'genre-status',

           'language-list',
           'language-create',
           'language-edit',
           'language-delete',
           'language-status',

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
           
           'radio-list',
           'radio-create',
           'radio-edit',
           'radio-delete',
           'radio-status',

           'report-list',
           'report-create',
           'report-edit',
           'report-delete',
           'report-status',

           'social-list',
           'social-create',
           'social-edit',
           'social-delete',
           'social-status',

           'state-list',
           'state-create',
           'state-edit',
           'state-delete',
           'state-status',

           'tag-list',
           'tag-create',
           'tag-edit',
           'tag-delete',
           'tag-status',

           'team-list',
           'team-create',
           'team-edit',
           'team-delete',
           'team-status',

           'testimonial-list',
           'testimonial-create',
           'testimonial-edit',
           'testimonial-delete',
           'testimonial-status',

           'theme-list',
           'theme-create',
           'theme-edit',
           'theme-delete',
           'theme-status',
            
           'type-list',
           'type-create',
           'type-edit',
           'type-delete',
           'type-status',
        ];
        foreach ($permissions as $permission) {
             Permission::create(['name' => $permission]);
        }
    }
}