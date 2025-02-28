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
        Schema::create('subscriptions', function (Blueprint $table) {
                       $table->increments('id');
						$table->integer('subscr_id')->unsigned()->nullable();
						$table->foreign('subscr_id')->references('id')->on('subscription_products')->onDelete('set null');
						  
						$table->date('from_date') ->nullable();
						$table->date('to_date') ->nullable();
					 
					 
						$table->integer('service_limit')->nullable();  
						$table->integer('work_limit')->nullable();  
						$table->integer('max_img')->nullable();  
						$table->integer('video_enabled')->nullable();  
						$table->integer('video_limit')->nullable(); 
						
						$table->integer('is_paid')->nullable(); 
						
						$table->boolean('cur_subscr')->nullable(); 
						 
						$table->integer('user_id')->unsigned()->nullable();
						$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
						
						
						
						$table->integer('next_subscr_id')->unsigned()->nullable();
						$table->foreign('next_subscr_id')->references('id')->on('subscription_products')->onDelete('set null');
						
						$table->timestamps();
			 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
