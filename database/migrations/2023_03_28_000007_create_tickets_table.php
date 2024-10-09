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
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('description');
            $table->bigInteger('price')->default(0);
            $table->integer('quota');
            $table->dateTime('star_sale_at');
            $table->dateTime('end_sale_at');
            $table->enum('type', ['berbayar', 'gratis', 'bayar sesukamu']);
            $table->unsignedBigInteger('event_id');
            $table->decimal('discount')->default(0);
            $table->decimal('fee_admin')->default(0);
            $table->decimal('tax_coast')->default(0);

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
        Schema::dropIfExists('tickets');
    }
};
