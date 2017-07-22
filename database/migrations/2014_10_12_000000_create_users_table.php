<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name', 64);
                $table->string('email', 64)
                    ->unique()
                    ->nullable();
                $table->string('password', 64)
                    ->nullable();
                $table->string('token', 64);
                $table->boolean('activated')
                    ->default(false);
                $table->boolean('verified')
                    ->default(false);
                $table->boolean('status')
                    ->default(true);
                $table->string('mobile_no', 32)
                    ->unique()
                    ->nullable();
                $table->date('date')
                    ->nullable();
                $table->string('bio')
                    ->nullable();
                $table->text('profile_img')
                    ->nullable();                  
                $table->text('banner_img')
                    ->nullable();  
                $table->text('address')
                    ->nullable();      
                $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
