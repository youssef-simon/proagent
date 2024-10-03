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
        Schema::create('media_images', function (Blueprint $table) {
          $table->increments('id');
			$table->text('path');
            $table->string('name')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable()->default(0);
            $table->integer('order')->default(0);
			
            $table->string('legend')->nullable();
            $table->string('copyright')->nullable();
            $table->string('alt')->nullable();
			
			 $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_images');
    }
};
