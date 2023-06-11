<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRadiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('radios', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('name');
          $table->string('slug');
          $table->foreignId('genre_id')->index();
          $table->foreignId('type_id')->index();
          $table->foreignId('continent_id')->index();
          $table->foreignId('country_id')->index();
          $table->foreignId('state_id')->index();
          $table->foreignId('city_id')->index();
          $table->foreignId('category_id')->index();          
          $table->foreignId('language_id')->index();
          $table->foreignId('user_id')->index();
                 
          $table->string('description');
          $table->string('stream_url');
          $table->string('logo');
          $table->string('status')->default('1');
          $table->boolean('featured')->default('1');
          $table->integer('visit_count')->default('0');

          $table->string('address')->nullable();
          $table->string('email')->nullable();
          $table->string('twitter_url')->nullable();
          $table->string('facebook_url')->nullable();
          $table->string('linkedin_url')->nullable();
          $table->string('website')->nullable();
          $table->string('telephone')->nullable();

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
        Schema::dropIfExists('radios');
    }
}
