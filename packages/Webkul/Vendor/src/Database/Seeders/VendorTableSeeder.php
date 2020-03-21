<?php

namespace Webkul\Vendor\Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class VendorTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('vendor_sources')->delete();

        DB::table('vendor_sources')->insert([
            'id' => 1,
            'name' => 'wp',
            'email' => 'wp@example.com',
            'password' => bcrypt('admin123'),
            'status' => 1,
            'role_id' => 1,
            'name_kana' => 'ou hou',
            'creditcard_main_apikey' => '123456789',
            'creditcard_denki_apikey' => '1234567899',
            'account_transfer_company_code' => '123',
            'smartcis_my_auth_id' => '1',
            'smartcis_my_auth_key' => 'MI',
            'vendor_denki_shop_code' => '1',
            'updated_at' => '2001-12-20',
            'updated_user_id' => 1,
            'created_at' => '2001-12-20',
            'created_user_id' => 1,
            'gmo_main_site_id' => '1',
            'gmo_main_site_pass' => '1',
            'gmo_main_shop_id' => '1',
            'gmo_main_shop_pass' => '1',
            'gmo_denki_site_id' => '1',
            'gmo_denki_site_pass' => '1',
            'gmo_denki_shop_id' => '1',
            'gmo_denki_shop_pass' => '1',
            'aplus_bank_consignor_number' => '1',
            'aplus_division' => '1',
            'aplus_conveni_consignor_number' => '1',
            'aplus_transfer_date' => '1',
        ]);
    }
}