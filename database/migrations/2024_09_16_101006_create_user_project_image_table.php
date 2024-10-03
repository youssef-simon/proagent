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
        Schema::create('user_project_images', function (Blueprint $table) {
			 
			$table->increments('id');
			$table->text('path');
            $table->string('name')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable()->default(0);
			 
					  
		   	 $table->integer('project_id')->unsigned()->nullable();
		     $table->foreign('project_id')->references('id')->on('user_projects')->onDelete('set null');
			 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_project_image');
    }
};
