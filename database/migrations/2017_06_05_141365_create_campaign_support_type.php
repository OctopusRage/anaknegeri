<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignSupportType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('campaign_support_type')){
            Schema::create('campaign_support_type', function (Blueprint $table) {
                $table->increments('id');
                $table->double('amount',12,2);
                $table->string('item', 64);
                $table->integer('campaign_id')->unsigned()->index();
                $table->integer('support_type_id')->unsigned()->index();
                $table->foreign('campaign_id')
                    ->references('id')
                    ->on('campaigns')
                    ->onDelete('cascade');
                $table->foreign('support_type_id')
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
        Schema::dropIfExists('campaign_support_types');
    }
}
