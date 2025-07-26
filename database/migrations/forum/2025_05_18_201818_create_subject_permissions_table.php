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
        Schema::create('subject_permissions', function (Blueprint $table) {
            $table->increments('id'); 
			
			$table->integer('subject_id')->unsigned()->nullable();
			$table->foreign('subject_id')->references('id')->on('subjects') ->onDelete('cascade');
			  
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users') ->onDelete('cascade');
			 
			$table->boolean('can_post')->default(false);
			$table->boolean('can_view')->default(false);
			$table->boolean('can_comment')->default(false);
			 
			$table->timestamps();
			 /********************************************/
			 /*
			 1-
			 
			  subject 
			  
					- view need  permission
				    - add post need permission
				    - add comment need permission
					
				    - post need review
				    - comment need review 
			   
			 1 - moderate can manage subjects 
			 
					subject_id 
					admin_id
					
					can review comment
					can review post 
					
					delete comments
					delete posts
					   
			 */
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subject_permissions');
    }
};
