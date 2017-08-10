<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneNumberToVerificationRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('verification_requests', function (Blueprint $table) {
            $table->string('phone_number');
            $table->text('additional_info')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('verification_requests', function (Blueprint $table) {
            $table->dropColumn('phone_number');
            $table->dropColumn('additional_info');
        });
    }
}
