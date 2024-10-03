<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
			$table->increments('id');
			
			$table->integer('service_id')->unsigned()->nullable();
		    $table->foreign('service_id')->references('id')->on('services')->onDelete('set null');
			
			$table->integer('report_status_id')->unsigned()->nullable();
		    $table->foreign('report_status_id')->references('id')->on('report_status')->onDelete('set null');
			
		    $table->text('description')->nullable();
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
        Schema::dropIfExists('reports');
    }
}
