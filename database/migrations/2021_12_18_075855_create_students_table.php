<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable();
            $table->string('nama');
            $table->string('nis', 12)->unique();
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->string('notelp', 13)->nullable();
            $table->string('telp_ortu', 13)->nullable();
            $table->integer('poin_total')->default(3000);
            $table->integer('poin_pelanggaran')->default(0);
            $table->integer('poin_penghargaan')->default(0);
            $table->foreignId('user_id')->nullable()->unique();

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
        Schema::dropIfExists('students');
    }
}
