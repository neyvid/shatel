<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->integer('oprator_id');
            $table->string('name');
            $table->integer('type');
            $table->integer('plan');
            $table->integer('price');
            $table->integer('discount');
            $table->integer('period');
            $table->integer('night_trafic');
            $table->integer('speed');
            $table->integer('limit_amount');
            $table->integer('international_trafic');
            $table->text('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service');
    }
}
