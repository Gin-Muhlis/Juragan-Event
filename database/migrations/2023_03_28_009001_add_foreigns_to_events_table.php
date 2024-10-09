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
        Schema::table('events', function (Blueprint $table) {
            $table
                ->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('organizer_id')
                ->references('id')
                ->on('organizers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('topic_mix_id')
                ->references('id')
                ->on('topic_mixes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('format_mix_id')
                ->references('id')
                ->on('format_mixes')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['city_id']);
            $table->dropForeign(['organizer_id']);
            $table->dropForeign(['topic_mix_id']);
            $table->dropForeign(['format_mix_id']);
        });
    }
};
