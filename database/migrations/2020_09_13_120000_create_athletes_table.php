<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAthletesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('athletes', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 40);
            $table->string('lastname', 40);
            $table->enum('gender', ['F', 'M'])->default('F');
            $table->string('photo')->nullable();
            $table->date('date_of_birth');
            $table->string('birth_municipality', 50);
            $table->string('birth_province', 50);
            $table->string('birth_country', 20)->default('ITA');
            $table->string('phone', 25)->nullable();
            $table->string('email', 50)->nullable();
            $table->string('fiscal_code', 30)->nullable();
            $table->string('address', 100)->nullable();
            $table->string('municipality', 50)->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('province', 50)->nullable();
            $table->string('country', 20)->nullable()->default('ITA');
            $table->bigInteger('main_parent_id')->unsigned()->nullable();
            $table->foreign('main_parent_id')->on('parents')->references('id');
            $table->date('expiry_medical_certificate_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->bigInteger('created_by')->unsigned();
            $table->foreign('created_by')->on('users')->references('id');
            $table->bigInteger('updated_by')->unsigned()->nullable();
            $table->foreign('updated_by')->on('users')->references('id');
            $table->date('begin_with_us_at')->nullable();
            $table->date('end_with_us_at')->nullable();
            $table->string('society_come_from')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('athletes');
    }
}
