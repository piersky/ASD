<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GroupTranslation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('group_id')->unsigned();
            $table->foreign('group_id')->on('groups')->references('id');
            $table->string('lang_id', 2)->default('en');
            $table->string('name', 50);
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
        Schema::dropIfExists('group_translations');
    }
}
