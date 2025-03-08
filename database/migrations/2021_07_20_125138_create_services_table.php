<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
			$table->increments('id');
			$table->string('title');
			$table->string('imagpath')->nullable();
			 
			$table->text('description');
			
			$table->integer('price_from')->nullable();
			
			$table->integer('status')->nullable();
			
			
			$table->text('reason')->nullable();
		  
			$table->integer('user_id')->unsigned()->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
			 
		    $table->integer('department_id')->unsigned()->nullable();
			$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
			  
			$table->integer('category_id')->unsigned()->nullable();
			$table->foreign('category_id')->references('id')->on('service_categories')->onDelete('set null');
			 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
