<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('father_name')->after('lastname');
            $table->string('company_name')->after('name')->nullable();
            $table->string('registration_number')->after('company_name')->nullable();
            $table->timestamp('registration_number_date')->nullable();
            $table->string('economic_number')->after('registration_number')->nullable();
            $table->integer('gender')->after('name')->nullable(); //woman=0 men=1
            $table->string('agent_nationality')->after('company_name')->nullable();
            $table->integer('company_type')->after('company_name')->nullable(); //khososi=1
            $table->timestamp('birthday_date')->nullable();
            $table->string('national_code')->after('birthday_date');
            $table->string('national_code_picture')->after('national_code');
            $table->string('postal_code')->after('national_code_picture')->nullable();
            $table->text('address')->after('postal_code');
            $table->integer('user_type')->after('name'); //haghighi =0 , hoghoghi=1
            $table->string('phone_number_request')->after('user_phone_number');

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
            $table->dropColumn([
                'father_name',
                'company_name',
                'registration_number',
                'registration_number_date',
                'economic_number',
                'gender',
                'agent_nationality',
                'company_type',
                'birthday_date',
                'national_code',
                'national_code_picture',
                'postal_code',
                'address',
                'user_type',
                'phone_number_request'
            ]);
        });
    }
}
