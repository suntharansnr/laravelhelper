<?php

namespace Database\Seeders;

use App\Theme;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThemesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theme::create([
        'additional_css' => '',	
	    'additional_js' => '',
	    'Google_map_embedded_code' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15849.76750389885!2d80.77686055000001!3d6.7158074!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2slk!4v1587663928635!5m2!1sen!2slk" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>',
	 	'Footer_address' => 'Jaffna', 	
	 	'Phone_number' => '+940773624880',	
	 	'email_address' => 'info@laravelhelper.monster',  	
	 	'company_name' => 'Laravelhelper.monster',	
	 	'footer_left_text' => 'Copyright © 2023 Laravelhelper',	
	 	'footer_right_text' => 'Your additional text, can be use link too', 
	 	'logo'=> 'storage/images/logo/71591700796959.png',  	
	 	'welcome_banner' => 'storage/images/welcome_banner/31771587405679.jpg', 	
	 	'footer_about_us'=> 'Laravelhelper website focuses on all web language and framework tutorial PHP, Laravel, Codeigniter, Nodejs, API, MySQL, AJAX, jQuery, JavaScript, Demo' 
        ]);

        $this->command->info('Theme data seeded!');
    }
}
