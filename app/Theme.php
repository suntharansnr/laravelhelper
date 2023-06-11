<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
  protected $fillable = [
    'id','additional_css','additional_js','Google_map_embedded_code','Footer_address','Phone_number','email_address','company_name','footer_left_text','footer_right_text','logo','welcome_banner','footer_about_us',
  ];
}
