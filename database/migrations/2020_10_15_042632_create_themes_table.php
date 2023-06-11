<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('additional_css')->nullable();
            $table->longText('additional_js')->nullable();
            $table->longText('Google_map_embedded_code')->nullable();
            $table->string('Footer_address')->nullable();
            $table->string('Phone_number')->nullable();
            $table->string('email_address')->nullable();
            $table->string('company_name')->nullable();
            $table->longText('footer_left_text')->nullable();
            $table->longText('footer_right_text')->nullable();
            $table->longText('footer_about_us')->nullable();
            $table->string('logo',296)->nullable();
            $table->string('welcome_banner',296)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
