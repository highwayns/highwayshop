<?php

namespace Highwayns\Agent\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AgentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('agent_sources')->delete();

        DB::table('agent_sources')->insert([
            'id' => 1,
            'vendor_id' => 1,
            'agency_group_id' => 1,
            'name' => 'ld',
            'email' => 'ld@example.com',
            'password' => bcrypt('admin123'),
            'status' => 1,
            'role_id' => 1,
            'postal_code' => '1234567',
            'pref' => '東京都',
            'city' => '東京',
            'address' => '新宿',
            'building_name' => 'パークタワー',
            'tel' => '0312345678',
            'fax' => '0312345679',
            'agency_denki_shop_code' => '',
            'created_at' => '2019-12-12',
            'created_user_id' => 1,
            'updated_at' => '2019-12-12',
            'updated_user_id' => 1,
            'del_flg' => false,
        ]);
    }
}