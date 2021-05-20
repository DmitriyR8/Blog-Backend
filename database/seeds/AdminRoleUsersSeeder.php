<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminRoleUsersSeeder
 */
class AdminRoleUsersSeeder extends Seeder
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
                'user_id' => 1,
                'created_at' => null,
                'updated_at' => null
            ]
        ];

        if (DB::table('admin_role_users')->get()->count() == 0) {
            DB::table('admin_role_users')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
