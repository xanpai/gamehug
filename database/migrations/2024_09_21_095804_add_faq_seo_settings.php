<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $settings = [
            ['name' => 'faqs_title', 'val' => 'Frequently Asked Questions', 'type' => 'string'],
            ['name' => 'faqs_description', 'val' => 'Find answers to common questions about our services', 'type' => 'string'],
            ['name' => 'recent_title', 'val' => 'Recent Releases', 'type' => 'string'],
            ['name' => 'recent_description', 'val' => 'Check out our latest releases and updates', 'type' => 'string'],
            ['name' => 'download_title', 'val' => 'Download Page', 'type' => 'string'],
            ['name' => 'download_description', 'val' => 'Download your favorite games and content', 'type' => 'string'],
            ['name' => 'nodownload_title', 'val' => 'No Download Available', 'type' => 'string'],
            ['name' => 'nodownload_description', 'val' => 'Sorry, no download is currently available for this item', 'type' => 'string'],
        ];

        foreach ($settings as $setting) {
            DB::table('settings')->insertOrIgnore($setting);
        }
    }

    public function down()
    {
        $settingNames = [
            'faqs_title',
            'faqs_description',
            'recent_title',
            'recent_description',
            'download_title',
            'download_description',
            'nodownload_title',
            'nodownload_description',
        ];

        DB::table('settings')->whereIn('name', $settingNames)->delete();
    }
};
