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
        Schema::create('request_messages', function (Blueprint $table) {
        	$table->increments('id');
			 $table->text('message')->nullable();
			 
			 $table->unsignedInteger('sender_id');
		     $table->string('sender_type');
			
			$table->integer('request_id')->unsigned()->nullable();
			$table->foreign('request_id')->references('id')->on('service_requests')->onDelete('set null');	

			$table->timestamps();
			
					
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_messages');
    }
};
