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
        Schema::create('sach', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loaisach_id')->constrained('loaisach');
            $table->foreignId('nhaxuatban_id')->constrained('nhaxuatban');
            $table->string('tieudesach');
            $table->string('tieudesach_slug');
            $table->foreignId('tacgia_id')->constrained('tacgia');
            $table->string('mota')->nullable() ;
            $table->float('giasach');
            $table->float('giasale')->nullable();
            $table->string('trangthai');
            $table->integer('soluong');
            $table->string('hinhanh')->nullable() ;
            $table->timestamps();
            $table->engine = 'InnoDB';// Đặt engine là InnoDB cho bảng sách
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sach');
    }
};