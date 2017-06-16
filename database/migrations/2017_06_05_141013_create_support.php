<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupport extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('supports')){
            Schema::create('supports', function (Blueprint $table) {
                $table->increments('id');
                $table->string('item');
                $table->string('comment');
                $table->text('detail');
                $table->double('amount',12,2);                
                $table->boolean('anonim')
                    ->default(false);                
                $table->integer('type_id')
                    ->unsigned()
                    ->index();
                $table->integer('user_id')
                    ->unsigned()
                    ->index();
                $table->integer('campaign_id')
                    ->unsigned()
                    ->index();
                $table->foreign('campaign_id')
                    ->references('id')
                    ->on('campaigns')
                    ->onDelete('cascade');
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users')
                    ->onDelete('cascade');
                $table->foreign('type_id')
                    ->references('id')
                    ->on('support_types')
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
        Schema::dropIfExists('supports');
    }
}
