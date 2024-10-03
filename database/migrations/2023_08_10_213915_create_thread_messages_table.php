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
        Schema::create('thread_messages', function (Blueprint $table) {
					$table->increments('id'); 
					$table->integer('user_id')->unsigned()->nullable();
					$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
					
					$table->integer('sec_user_id')->unsigned()->nullable();
					$table->foreign('sec_user_id')->references('id')->on('users')->onDelete('set null');
					
					$table->text('message')->nullable();
					
					$table->timestamp('last_updated')->nullable();
					
					$table->integer('last_sender_id')->unsigned()->nullable();
					$table->foreign('last_sender_id')->references('id')->on('users')->onDelete('set null');
					
					
					$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('thread_messages');
    }
};
