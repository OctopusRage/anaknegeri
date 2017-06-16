<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWalletTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if(!Schema::hasTable('wallet_deposits')){
            Schema::create('wallet_deposits', function (Blueprint $table) {
                $table->increments('id');      
                $table->string('token',64);
                $table->double('amount', 12,2);
                $table->integer('wallet_id')
                    ->unsigned()
                    ->index();
                $table->text('image');
                $table->boolean('confirmed')
                    ->default(false);
                $table->boolean('status')
                    ->default(false);
                $table->foreign('wallet_id')
                    ->references('id')
                    ->on('wallets')
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
        Schema::dropIfExists('wallet_transaction');
    }
}
