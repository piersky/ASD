<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('parents', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->enum('gender', array('F', 'M'))->default('F');
            $table->string('fiscal_code')->nullable();
            $table->string('municipality')->nullable();
            $table->string('province');
            $table->string('country')->default('ITA');
            $table->string('mobile');
            $table->string('phone');
            $table->enum('conjugality', array('MARRIED', 'SINGLE', 'DIVORCED', 'OTHER'));
            $table->bigInteger('partner_id')->nullable()->unsigned();
            $table->foreign('partner_id')->on('parents')->references('id');
            $table->boolean('wants_tax_certificate')->default(false);
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('parents');
    }
}
