<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->char('nik', 16)->unique();
            $table->string('fullName', 50);
            $table->string('email')->unique();
            $table->char('phone');
            $table->char('address', 50);
            $table->char('gender', 10);
            $table->char('placeOfbirth', 30);
            $table->date('dateOfbirth');
            $table->string('password', 100);
            $table->char('avatar', 30)->nullable();
            $table->string('code_token', 100)->unique()->nullable();
            $table->char('status', 10)->nullable();
            $table->char('passport', 20)->unique()->nullable();
            $table->char('country', 30)->nullable();
            $table->integer('isWNA')->nullable();
            $table->integer('isSelfRegister')->nullable();
            $table->integer('isEmailVerified')->nullable();
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
        Schema::dropIfExists('patients');
    }
}