<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class baseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('base_config')->insert([
            'name' => 'Base',
            'logo' => 'logo.png',
            'favicon' => 'favicon.png',
            'description' => 'Base',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
