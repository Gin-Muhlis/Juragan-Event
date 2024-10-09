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
        Schema::create('address_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('address');
            $table->string('longitude');
            $table->string('latitutde');
            $table->unsignedBigInteger('event_id');

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
        Schema::dropIfExists('address_events');
    }
};
