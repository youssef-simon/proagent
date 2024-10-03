<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id'); 
			$table->boolean('status')->nullable();
		 
			$table->string('name')->nullable();
			$table->string('slug')->nullable();
			$table->text('description')->nullable();
			$table->integer('parent')->unsigned()->nullable();
			 
			$table->integer('main_image_id')->unsigned()->nullable();
			$table->foreign('main_image_id')->references('id')->on('media_images')->onDelete('cascade');
			  
			$table->timestamps();
			
        });
		
		
		Schema::table('categories', function (Blueprint $table) {
           $table->foreign('parent')->references('id')->on('categories')->onDelete('set null');
        });
		 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
