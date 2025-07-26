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
	 Schema::create('subject_admins', function (Blueprint $table) {
      $table->increments('id');
			
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			
					
			$table->integer('subject_id')->unsigned()->nullable();
			$table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
			
			
			$table->timestamps();	
			 });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
