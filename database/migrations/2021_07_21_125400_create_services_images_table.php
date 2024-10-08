<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_images', function (Blueprint $table) {
			$table->increments('id');
			  
            $table->text('path');
            $table->text('name')->nullable();
            $table->string('extension')->nullable();
            $table->string('size')->nullable()->default(0);
            $table->integer('order')->default(0);
			
            $table->integer('service_id')->unsigned()->nullable();
		    $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
			 
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
        Schema::dropIfExists('services_images');
    }
}
