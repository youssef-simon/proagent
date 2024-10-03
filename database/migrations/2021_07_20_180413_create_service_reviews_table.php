<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_reviews', function (Blueprint $table) {
			$table->increments('id');
			
				 $table->integer('service_id')->unsigned()->nullable();
		     $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
			$table->text('comment');
			
			
			$table->integer('rate');
			
				 $table->integer('request_id')->unsigned()->nullable();
		     $table->foreign('request_id')->references('id')->on('service_requests')->onDelete('set null');
			 
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
        Schema::dropIfExists('service_reviews');
    }
}
