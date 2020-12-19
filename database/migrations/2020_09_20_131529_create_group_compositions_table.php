<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupCompositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_compositions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('year', ['2020', '2021']);
            $table->bigInteger('athlete_id')->unsigned();
            $table->foreign('athlete_id')->on('athletes')->references('id');
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')->on('groups')->references('id');
            $table->boolean('is_active')->default(true);
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->on('users')->references('id');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_compositions');
    }
}
