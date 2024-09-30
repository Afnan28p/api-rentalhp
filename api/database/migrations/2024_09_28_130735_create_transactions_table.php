<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('disposisi_id')->constrained()->onDelete('cascade');
            $table->string('model_hp');
            $table->date('tanggal_mulai_rental');
            $table->date('tanggal_akhir_rental');
            $table->decimal('jumlah', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}