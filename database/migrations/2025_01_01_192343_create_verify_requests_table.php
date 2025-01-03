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
        Schema::create('verify_requests', function (Blueprint $table) {
				$table->increments('id');
						
				$table->string('front_image_path')->nullable();
				$table->string('back_image_path')->nullable();
				$table->string('selffront_image_path')->nullable();
				$table->integer('vertify_status')->nullable();  
				 
				 $table->integer('user_id')->unsigned()->nullable();
				 $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			  
            $table->timestamps();
		 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_requests');
    }
};
