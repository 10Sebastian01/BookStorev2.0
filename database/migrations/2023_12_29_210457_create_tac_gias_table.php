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
        Schema::create('tacgia', function (Blueprint $table) {
            $table->id();
            $table->string('tentacgia'); // Tên tác giả
            $table->text('tieusu')->nullable(); // Tiểu sử tác giả có thể để trống
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tacgia');
    }
};
