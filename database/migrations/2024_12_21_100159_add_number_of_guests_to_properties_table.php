<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->integer('max_guests')->default(2);
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->integer('number_of_guests')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('max_guests');
        });
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('number_of_guests');
        });
    }
};
