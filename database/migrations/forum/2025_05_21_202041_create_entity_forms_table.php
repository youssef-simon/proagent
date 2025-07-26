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
        Schema::create('entity_forms', function (Blueprint $table) {
			$table->increments('id');
			
		  	$table->string('entity_type')->nullable(); 
		  	$table->string('field_key')->nullable(); 
			
		  //	$table->string('field_key')->nullable(); 
		  	$table->string('field_label')->nullable(); 
		  	$table->string('field_type')->nullable(); 
		  	$table->boolean('field_required')->nullable(); 
			
			
			
		  	$table->boolean('show_profile')->nullable(); 
		  	$table->boolean('show_label_profile')->nullable();  
		  	$table->boolean('only_admin')->nullable(); 
			
		  	$table->integer('field_order')->nullable(); 
			
		  	$table->json('field_options')->nullable(); 
			
		  	$table->boolean('searchable')->nullable(); 
			 
			
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
