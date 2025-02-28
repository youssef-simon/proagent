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
        Schema::create('subscription_products', function (Blueprint $table) {
             $table->increments('id');
			
			
            $table->string('title')->nullable(); 
			
            $table->integer('service_limit')->nullable(); 
			
			
            $table->integer('work_limit')->nullable(); 
			 
            $table->integer('max_img')->nullable(); 
			
            $table->integer('video_enabled')->nullable(); 
			
            $table->integer('video_limit')->nullable(); 
			
            $table->integer('price')->nullable(); 
			
            $table->integer('period_month')->nullable(); 
			
            $table->integer('rank')->nullable(); 
            $table->integer('is_free')->nullable(); 
			  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_products');
    }
};
