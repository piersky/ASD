<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
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
        Schema::dropIfExists('groups');
    }
}
