<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('year', ['2020', '2021'])->default('2020');
            $table->date('payment_date');
            $table->bigInteger('athlete_id')->unsigned();
            $table->foreign('athlete_id')->on('athletes')->references('id');
            $table->softDeletes();
            $table->float('amount');
            $table->enum('period', array(
                'Enrollment',
                '1st_fee',
                '2nd_fee',
                '3rd_fee',
                '4th_fee',
                '5th_fee',
                '6th_fee',
                '7th_fee',
                '8th_fee',
                '9th_fee',
                '10th_fee',
                '11th_fee',
                '12th_fee'));
            $table->enum('method', array(
                'CASH',
                'BANK WIRE',
                'CHECK',
                'POS',
                'OTHER'));
            $table->text('note')->nullable();
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->on('users')->references('id');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->on('users')->references('id');
            $table->primary(['year', 'athlete_id', 'period']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
