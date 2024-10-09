<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('juragans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('banner_website');
            $table->string('address');
            $table->string('email');
            $table->string('phone_number');
            $table->string('copyright_text');
            $table->text('short_description');
            $table->longText('long_description');
            $table->text('contact_description');
            $table->string('coordinate');
            $table->string('logo_website');
            $table->string('link_fb');
            $table->string('link_twitter');
            $table->string('link_instagram');
            $table->string('link_youtube');

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
        Schema::dropIfExists('juragans');
    }
};
