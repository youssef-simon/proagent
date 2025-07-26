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
        Schema::create('post_files', function (Blueprint $table) {
            $table->increments('id');
		 
		   	$table->string('file_path')->nullable();
			
		   	$table->integer('post_id')->unsigned()->nullable();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
		   
           	$table->timestamps();	
			 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_files');
    }
};
