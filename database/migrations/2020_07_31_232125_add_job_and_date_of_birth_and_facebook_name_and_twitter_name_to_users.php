<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddJobAndDateOfBirthAndFacebookNameAndTwitterNameToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('job')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('facebook_name')->nullable();
            $table->string('twitter_name')->nullable();
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
            $table->dropColumn(['job',  'date_of_birth', 'facebook_name','twitter_name']);
        });
    }
}
