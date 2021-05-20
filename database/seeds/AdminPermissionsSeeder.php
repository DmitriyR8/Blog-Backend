<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminPermissionsSeeder
 */
class AdminPermissionsSeeder extends Seeder
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
                'name' => 'All permission',
                'slug' => '*',
                'http_method' => '',
                'http_path' => '*',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'name' => 'Dashboard',
                'slug' => 'dashboard',
                'http_method' => 'GET',
                'http_path' => '/',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'name' => 'Login',
                'slug' => 'auth.login',
                'http_method' => '',
                'http_path' => "/auth/login \n/auth/logout",
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'name' => 'User settings',
                'slug' => 'auth.settings',
                'http_method' => 'GET,PUT',
                'http_path' => '/auth/settings',
                'created_at' => null,
                'updated_at' => null
            ],
            [
                'name' => 'Auth management',
                'slug' => 'auth.management',
                'http_method' => '',
                'http_path' => "/auth/roles \n/auth/permissions \n/auth/menu \n/auth/logs",
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        if (DB::table('admin_permissions')->get()->count() == 0) {
            DB::table('admin_permissions')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
