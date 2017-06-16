<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVerificationRequests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('verificaton_requests')){
            Schema::create('verificaton_requests', function (Blueprint $table) {
                $table->increments('id');
                $table->boolean('confirmed')
                    ->default(false);
                $table->boolean('status')
                    ->default(false);
                $table->text('id_img');
                $table->string('address');
                $table->string('website', 64);
                $table->string('fb_id', 32);
                $table->string('twitter_id', 32);
                $table->string('instagram_id', 32);
                $table->integer('user_id')
                    ->unsigned()
                    ->index();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('verificaton-requests');
    }
}
