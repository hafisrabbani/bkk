<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignInstansiOnAlumni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alumnis', function (Blueprint $table) {
            // $table->dropForeign(['instansi']);
            // $table->text('instansi')->change()->nullable();
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
            $table->dropForeign(['instansi']);
            $table->text('instansi')->change()->nullable();
        });
    }
}
