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
        Schema::create('transaction_headers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('transaction_date');
            $table->string('no_transaction')->unique();
            $table->bigInteger('total_transaction');
            $table->enum('status', [
                'menunggu pembayaran',
                'selesai',
                'dibatalkan',
                'menunggu konfirmasi',
                'pengajuan pengembalian',
                'pengajuan pengembalian disetujui',
                'pengajuan pengembalian ditolak',
            ]);
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('payment_id');

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
        Schema::dropIfExists('transaction_headers');
    }
};
