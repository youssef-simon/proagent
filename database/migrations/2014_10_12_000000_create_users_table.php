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
        Schema::create('users', function (Blueprint $table) {
              $table->increments('id');
            
            $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable(); 
			
            $table->string('username')->nullable();	
            $table->string('work_title')->nullable();	
            $table->string('phone')->nullable();
            $table->string('email')->unique();
			
            $table->text('small_bio')->nullable();
            $table->text('biograph')->nullable();
            $table->string('imagpath')->nullable();
			
			
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			
			     
					 		
			$table->decimal('total_balance', 10, 2)->nullable();  
			$table->decimal('pending_balance', 10, 2)->nullable(); 
			$table->decimal('ava_balance', 10, 2)->nullable(); 
			
			
            $table->rememberToken();
            
			 
			
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
