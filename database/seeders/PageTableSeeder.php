<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('pages')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $pages = [
            [
                'name'=> 'About Us',
                'slug' => Str::slug('About Us'),
                'title' => 'Find Best Medical Solutions Quick And Easy At Chirayu National Hospital',
                'sub_title' => 'what we Are',
                'is_active' => 1
            ],

            [
                'name'=> 'our mission & vision',
                'slug' => Str::slug('our mission & vision'),
                'title' => '',
                'sub_title' => 'what we Are',
                'is_active' => 1
            ],

            [
                'name'=> 'Awards & Recognitions',
                'slug' => Str::slug('Awards & Recognitions'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ],

            [
                'name'=> 'Accreditations',
                'slug' => Str::slug('Accreditations'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ],

            [
                'name'=> 'Management Team',
                'slug' => Str::slug('Management Team'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 0
            ],

            [
                'name'=> 'Managing Director',
                'slug' => Str::slug('Managing Director'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ],

            [
                'name'=> 'Careers',
                'slug' => Str::slug('careers'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ],

            [
                'name'=> 'Departments',
                'slug' => Str::slug('departments'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ],

            [
                'name'=> 'Events',
                'slug' => Str::slug('events'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ],

            [
                'name'=> 'Blogs',
                'slug' => Str::slug('blogs'),
                'title' => '',
                'sub_title' => '',
                'is_active' => 1
            ]

        ];

        DB::table('pages')->insert($pages);
    }
}
