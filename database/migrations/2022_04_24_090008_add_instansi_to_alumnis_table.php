<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInstansiToAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            $table->unsignedBigInteger('instansi')->nullable()->after('status');
            $table->foreign('instansi')->references('id')->on('companys');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            //
        });
    }
}