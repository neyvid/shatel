<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddComlumnToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('areacode_id')->nullable();
            $table->string('user_phone_number')->nullable();
            $table->string('sendSms')->default(0);
            $table->string('confirmContract')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('areacode_id');
            $table->dropColumn('phoneNumber');
            $table->dropColumn('sendSms');
            $table->dropColumn('confirmContract');
        });
    }
}

