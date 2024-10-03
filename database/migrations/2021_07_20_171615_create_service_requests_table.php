<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
				$table->increments('id');
				$table->string('title');
				$table->text('description');
				 
				$table->integer('status_id')->unsigned()->nullable();
				$table->foreign('status_id')->references('id')->on('service_status')->onDelete('set null');
				
				$table->integer('service_id')->unsigned()->nullable();
				$table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
				
				$table->integer('user_make_id')->unsigned()->nullable();
				$table->foreign('user_make_id')->references('id')->on('users')->onDelete('set null');
			 
				$table->integer('user_req_id')->unsigned()->nullable();
				$table->foreign('user_req_id')->references('id')->on('users')->onDelete('set null');
			 
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
        Schema::dropIfExists('service_requests');
    }
}
