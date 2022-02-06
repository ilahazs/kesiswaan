<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('teacher_id')->nullable();
            $table->enum('nama', ['1', '2', '3']);
            $table->enum('jurusan', ['RPL', 'MM', 'TAVI', 'TKJ', 'TOI', 'TITL']);
            $table->enum('tingkatan', [10, 11, 12]);
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
        Schema::dropIfExists('classes');
    }
}
