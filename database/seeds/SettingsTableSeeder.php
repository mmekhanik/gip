<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('settings')->truncate();
        DB::table('settings')->insert(['key' => 'meta_title', 'display_name' => 'Blogger', 'slug' => str_slug('Blogger'),'name' => 'meta_title', 'value' => 'Blogger']);
        DB::table('settings')->insert(['key' => 'meta_author', 'display_name' => 'Author', 'slug' => str_slug('Author'),'name' => 'meta_author', 'value' => '']);
        DB::table('settings')->insert(['key' => 'meta_description', 'display_name' => 'Description', 'slug' => str_slug('Description'),'name' => 'meta_description', 'value' => 'Simple and elegant blog platform powered by Laravel']);
        DB::table('settings')->insert(['key' => 'meta_keywords', 'display_name' => 'Keywords', 'slug' => str_slug('Keywords'),'name' => 'meta_keywords', 'value' => 'laravel,blog,blogger,articles']);
        DB::table('settings')->insert(['key' => 'meta_robots', 'display_name' => 'Robots', 'slug' => str_slug('Robots'),'name' => 'meta_robots', 'value' => '']);
        DB::table('settings')->insert(['key' => 'disqus_shortname', 'display_name' => 'ShortName', 'slug' => str_slug('ShortName'),'name' => 'disqus_shortname', 'value' => '']);
        DB::table('settings')->insert(['key' => 'google_analytics_id', 'display_name' => 'GoogleAnalitics', 'slug' => str_slug('GoogleAnalitics'),'name' => 'google_analytics_id', 'value' => '']);

    }

}
