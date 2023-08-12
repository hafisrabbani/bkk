<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->id();
            $table->integer('nis')->unique();
            $table->string('name');
            $table->string('jurusan');
            $table->unsignedBigInteger('lulusan');
            $table->foreign('lulusan')->references('id')->on('tahuns');
            $table->enum('status',[0,1,2]); // 0 = belum bekerja/kuliah, 1 = kerja, 2 = kuliah
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
        Schema::dropIfExists('alumnis');
    }
}
