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
        Schema::create('user_categories', function (Blueprint $table) {
             $table->increments('id');
		  
		   	 $table->integer('user_id')->unsigned()->nullable();
		     $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			 
			   $table->integer('department_id')->unsigned()->nullable();
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			  
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')->on('service_categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_categories');
    }
};
