<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaign extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('campaigns')){
            Schema::create('campaigns', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 128);
                $table->string('subtitle');
                $table->date('deadline');
                $table->string('address');
                $table->string('slug', 64);
                $table->text('feature_img')
                    ->nullable();
                $table->text('detail');
                $table->boolean('status')
                    ->default(true);
                $table->integer('created_by')
                    ->unsigned()
                    ->index();
                $table->integer('category_id')
                    ->unsigned()
                    ->index();
                $table->foreign('created_by')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->foreign('category_id')
                    ->references('id')
                    ->on('categories')
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
        Schema::dropIfExists('campaign');
    }
}
