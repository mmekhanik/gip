<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSubtitleAndLevelAndIsPublishedAndPublishedAtToServices extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('subtitle')->nullable();
            $table->integer('level')->nullable();
            $table->boolean('is_published')->nullable();
            $table->datetime('published_at')->nullable()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('services', function (Blueprint $table) {
             $table->dropColumn(['subtitle', 'level', 'is_published', 'published_at']);
        });
    }
}
