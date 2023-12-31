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
        Schema::create('nhaxuatban', function (Blueprint $table) {
            $table->id();
            $table->string('tennxb'); // Tên nhà xuất bản
            $table->string('tennxb_slug');
            $table->string('hinhanh');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhaxuatban');
    }
};