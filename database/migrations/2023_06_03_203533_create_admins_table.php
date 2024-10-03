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
        Schema::create('admins', function (Blueprint $table) {
				    $table->increments('id');
				      $table->string('first_name')->nullable(); 
            $table->string('last_name')->nullable(); 
				 
				  //  $table->string('mobile_number');
					$table->string('email')->unique();
					$table->timestamp('email_verified_at')->nullable();
					$table->string('password'); 
					$table->rememberToken();
					 $table->timestamps();
					
					
			});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
