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
        Schema::create('comments', function (Blueprint $table) {
						$table->increments('id');
						$table->text('body')->nullable();
						 
						$table->integer('user_id')->unsigned()->nullable();
						$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
							
						$table->integer('post_id')->unsigned()->nullable();
						$table->foreign('post_id')->references('id')->on('posts')->onDelete('set null');
						 
						$table->integer('comment_id')->unsigned()->nullable();
						$table->foreign('comment_id')->references('id')->on('comments')->onDelete('set null');
						
						$table->timestamps();	
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
