<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminMenuSeeder
 */
class AdminMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     * @throws Exception
     */
    public function run()
    {
        $records = [
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Dashboard',
                'icon' => 'fa-bar-chart',
                'uri' => '/',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 0,
                'order' => 2,
                'title' => 'Admin',
                'icon' => 'fa-tasks',
                'uri' => '/',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 2,
                'order' => 3,
                'title' => 'Users',
                'icon' => 'fa-users',
                'uri' => 'auth/users',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 2,
                'order' => 4,
                'title' => 'Roles',
                'icon' => 'fa-user',
                'uri' => 'auth/roles',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 2,
                'order' => 5,
                'title' => 'Permission',
                'icon' => 'fa-ban',
                'uri' => 'auth/permissions',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 2,
                'order' => 6,
                'title' => 'Menu',
                'icon' => 'fa-bars',
                'uri' => 'auth/menu',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 2,
                'order' => 7,
                'title' => 'Operation log',
                'icon' => 'fa-history',
                'uri' => 'auth/logs',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Single Reviews',
                'icon' => 'fa-eye',
                'uri' => '/single-reviews',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Blog Articles',
                'icon' => 'fa-file-text',
                'uri' => '/blog-articles',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Discounts',
                'icon' => 'fa-cc-discover',
                'uri' => '/discounts',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Comments',
                'icon' => 'fa-commenting',
                'uri' => '/comments',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'parent_id' => 0,
                'order' => 0,
                'title' => 'Emails',
                'icon' => 'fa-at',
                'uri' => '/emails',
                'permission' => null,
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        if (DB::table('admin_menu')->get()->count() == 0) {
            DB::table('admin_menu')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
