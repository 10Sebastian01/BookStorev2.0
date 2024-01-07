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
		Schema::create('banner', function (Blueprint $table) {
			$table->id();
			$table->string('banner');
            $table->string('link')->nullable();
            $table->boolean('status');
			$table->timestamps();
			$table->engine = 'InnoDB';
		});
	}
	
	/** 
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('banner');
	}
};
