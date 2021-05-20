<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminUsersSeeder
 */
class AdminUsersSeeder extends Seeder
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
                'username' => 'admin',
                'password' => bcrypt('admin'),
                'name' => 'Administrator',
                'avatar' => null,
                'remember_token' => '78cE5CK93Lc5RYoBUfMX2AhC6oGx3jtL1xSKRiBOCHazAOJZPrfz3LiNPhhg',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        if (DB::table('admin_users')->get()->count() == 0) {
            DB::table('admin_users')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
