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
        Schema::create('chitietdonhang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donhang_id')->constrained('donhang');
            $table->foreignId('sach_id')->constrained('sach');
            $table->integer('soluong');
            $table->float('giasanpham');
            $table->float('thanhtien');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietdonhang');
    }
};