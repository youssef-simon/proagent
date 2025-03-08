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
        Schema::create('user_projects', function (Blueprint $table) {
			 $table->increments('id');
		     $table->integer('user_id')->unsigned()->nullable();
		     $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			  
			  $table->string('title');
			  $table->string('imagpath')->nullable();
			  $table->integer('status')->nullable();
			  $table->text('description');
			  $table->text('reason')->nullable();
				
				  $table->timestamps();
			 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_projects');
    }
};
