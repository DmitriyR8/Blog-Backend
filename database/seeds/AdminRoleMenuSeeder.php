<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminRoleMenuSeeder
 */
class AdminRoleMenuSeeder extends Seeder
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
                'menu_id' => 2,
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        if (DB::table('admin_role_menu')->get()->count() == 0) {
            DB::table('admin_role_menu')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
