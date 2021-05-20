<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminRolePermissionsSeeder
 */
class AdminRolePermissionsSeeder extends Seeder
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
                'permission_id' => 1,
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        if (DB::table('admin_role_permissions')->get()->count() == 0) {
            DB::table('admin_role_permissions')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
