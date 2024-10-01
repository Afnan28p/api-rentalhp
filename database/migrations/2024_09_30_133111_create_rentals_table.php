<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('name', 50);
            $table->uuid('device_id');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->double('total_harga');
            $table->string('status', 50);
            $table->foreign('device_id')->references('id')->on('devices')->onDelete('cascade');
            $table->timestamps();
            // $table->foreign('fakultas_id')->references('id')->on('fakultas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prodis');
    }
};
