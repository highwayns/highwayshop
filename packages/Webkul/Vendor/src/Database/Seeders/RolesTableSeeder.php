<?php

namespace Webkul\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Vendor\Models\VendorRole;
use DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('vendor_sources')->delete();

        DB::table('vendor_roles')->delete();

        DB::table('vendor_roles')->insert([
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Administrator rolem',
                'permission_type' => 'all'
            ]);
    }
}