<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            'route' => '/',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, facilis.',
            'header' => 'Halaman Utama',
            'image' => '/asset/image/home.svg',
        ]);
        DB::table('pages')->insert([
            'route' => '/lowongan',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, facilis.',
            'header' => 'Halaman Lowongan',
            'image' => '/asset/image/home.svg',
        ]);
        DB::table('pages')->insert([
            'route' => '/blog',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, facilis.',
            'header' => 'Halaman Blog',
            'image' => '/asset/image/home.svg',
        ]);
        DB::table('pages')->insert([
            'route' => '/patner',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Officia, facilis.',
            'header' => 'Halaman Patner',
            'image' => '/asset/image/home.svg',
        ]);
    }
}
