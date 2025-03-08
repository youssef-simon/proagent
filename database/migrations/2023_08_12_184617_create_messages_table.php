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
        Schema::create('messages', function (Blueprint $table) {
					$table->increments('id');
	  
					$table->text('message')->nullable();
					
					$table->integer('status')->nullable();
 
					$table->unsignedInteger('sender_id');
					$table->string('sender_type');
					
					$table->string('file_name')->nullable();
					
					
					
					$table->boolean('is_readed')->default(0)->nullable();
					 
					
					
					$table->unsignedInteger('receiver_id');
					$table->string('receiver_type');
					 
					$table->integer('thread_id')->unsigned()->nullable();
					$table->foreign('thread_id')->references('id')->on('thread_messages')->onDelete('set null');
					
					$table->timestamps();
					
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
