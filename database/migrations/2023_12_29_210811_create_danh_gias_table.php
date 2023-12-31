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
        Schema::create('danhgia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nguoidung_id')->constrained('nguoidung'); // Khóa ngoại tới bảng User
            $table->foreignId('sach_id')->constrained('sach');
            $table->integer('diemdanhgia'); // Điểm đánh giá
            $table->text('nhanxet'); // Nhận xét đánh giá
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhgia');
    }
};
