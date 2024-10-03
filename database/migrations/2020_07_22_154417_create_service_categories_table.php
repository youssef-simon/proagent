<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {  
		  Schema::create('service_categories', function (Blueprint $table) {
						$table->increments('id');
						$table->string('title');
						$table->text('desc');
			 
						$table->integer('department_id')->unsigned()->nullable();
						$table->foreign('department_id')->references('id')->on('departments')->onDelete('set null');
						
						$table->timestamps();		
				 });
				
			 	 
		/*  Schema::table('service_categories', function (Blueprint $table) {
           $table->foreign('parent')->references('id')->on('service_categories')->onDelete('set null');
          
        }); */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_categories');
    }
}
