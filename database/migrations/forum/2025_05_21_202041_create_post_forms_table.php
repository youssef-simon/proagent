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
        Schema::create('post_forms', function (Blueprint $table) {
			$table->increments('id');
			
		  	$table->string('field_key')->nullable(); 
		  	$table->string('field_label')->nullable(); 
		  	$table->string('field_type')->nullable(); 
		  	$table->boolean('field_required')->nullable(); 
		  	$table->integer('field_order')->nullable(); 
			
		  	$table->boolean('searchable')->nullable(); 
		  	$table->json('field_options')->nullable(); 
			
									
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
        Schema::dropIfExists('post_forms');
    }
};
