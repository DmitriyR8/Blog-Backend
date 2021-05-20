<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Class AdminRolesSeeder
 */
class AdminRolesSeeder extends Seeder
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
                'name' => 'Administrator',
                'slug' => 'administrator',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        if (DB::table('admin_roles')->get()->count() == 0) {
            DB::table('admin_roles')->insert($records);
        } else {
            throw new Exception('The table is not empty, therefore it cannot be filled!', 400);
        }
    }
}
