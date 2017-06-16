<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('reports')){
            Schema::create('reports', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 128);
                $table->double('amount',12,2);
                $table->text('detail');
                $table->integer('withdraw_request_id')
                    ->unsigned()
                    ->index();
                $table->foreign('withdraw_request_id')
                    ->references('id')
                    ->on('withdraw_requests')
                    ->onDelete('cascade');
                $table->timestamps();
            });
        }
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
