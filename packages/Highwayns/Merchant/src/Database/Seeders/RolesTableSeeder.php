<?php

namespace Highwayns\Merchant\Database\Seeders;

use Illuminate\Database\Seeder;
use Highwayns\Merchant\Models\MerchantRole;
use DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('merchant_sources')->delete();

        DB::table('merchant_roles')->delete();

        DB::table('merchant_roles')->insert([
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Administrator rolem',
                'permission_type' => 'all'
            ]);
    }
}