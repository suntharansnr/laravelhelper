<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetatagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('metatags', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('route');
          $table->string('page_name');
          $table->string('title');
//regular meta tags
          $table->string('description',2048)->nullable();
          $table->string('keywords')->nullable();
          $table->string('author')->nullable();
          $table->string('canonical')->nullable();

//Facebook meta-tags
          $table->string('og:url')->nullable();
          $table->string('og:image')->nullable();
          $table->string('og:description',2048)->nullable();
          $table->string('og:title')->nullable();
          $table->string('og:site_name')->nullable();
          $table->string('og:see_also')->nullable();

//Google+ Meta
          $table->string('name')->nullable();
          $table->string('googledescription',2048)->nullable();
          $table->string('image')->nullable();

//Twitter Meta
          $table->string('twitter:card')->nullable();
          $table->string('twitter:url')->nullable();
          $table->string('twitter:title')->nullable();
          $table->string('twitter:description',2048)->nullable();
          $table->string('twitter:image')->nullable();

//views count of the page
          $table->integer('views')->default(0);
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
        Schema::dropIfExists('metatags');
    }
}
