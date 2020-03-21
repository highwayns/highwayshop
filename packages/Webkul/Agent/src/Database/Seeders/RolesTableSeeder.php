<?php

namespace Webkul\Agent\Database\Seeders;

use Illuminate\Database\Seeder;
use Webkul\Agent\Models\AgentRole;
use DB;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('agent_sources')->delete();

        DB::table('agent_roles')->delete();

        DB::table('agent_roles')->insert([
                'id' => 1,
                'name' => 'Administrator',
                'description' => 'Administrator rolem',
                'permission_type' => 'all'
            ]);
    }
}