<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->dateTime('start_at');
            $table->dateTime('end_at');
            $table->string('banner');
            $table->enum('type', ['Offline', 'Online']);
            $table->string('slug');
            $table->longText('description');
            $table->longText('terms');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('organizer_id');
            $table->unsignedBigInteger('topic_mix_id');
            $table->unsignedBigInteger('format_mix_id');

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
        Schema::dropIfExists('events');
    }
};
