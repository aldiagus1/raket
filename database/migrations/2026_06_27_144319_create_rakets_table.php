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
    Schema::create('rakets', function (Blueprint $table) {
        $table->id();
        $table->string('nama_raket');
        $table->string('brand');
        $table->text('deskripsi');
        $table->string('gambar')->nullable();
        $table->integer('power');
        $table->integer('control');
        $table->integer('speed');
        $table->integer('durability');
        $table->integer('flexibility');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rakets');
    }
};
