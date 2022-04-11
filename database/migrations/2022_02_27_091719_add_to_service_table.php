<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddToServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('service_id')->after('name');
            $table->string('price_id')->after('name');
            $table->integer('category_id')->after('name')->nullable();
            $table->string('available_id')->after('name');
            $table->date('expire_data')->after('name');
            $table->integer('base_price')->after('name');
            $table->integer('sell_price')->after('name');
            $table->integer('total_price')->after('name');
            $table->integer('commission_price')->after('name');
            $table->string('sell_zone')->after('name');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('service_id');
            $table->dropColumn('price_id');
            $table->dropColumn('available_id');
            $table->dropColumn('base_price');
            $table->dropColumn('category_id');
            $table->dropColumn('city_id');
            $table->dropColumn('expire_data');
            $table->dropColumn('sell_price');
            $table->dropColumn('total_price');
            $table->dropColumn('commission_price');
        });
    }
}
