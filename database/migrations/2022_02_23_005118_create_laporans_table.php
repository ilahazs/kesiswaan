<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('class_id')->nullable();
            $table->string('nama_pelaku');
            $table->string('nis_pelaku')->unique()->nullable();
            $table->string('email_pelaku')->nullable();
            $table->string('username_pelaku')->nullable();
            $table->foreignId('user_id')->nullable()->unique();
            $table->string('kelas')->nullable();


            $table->text('keterangan');
            $table->integer('pelapor_id')->nullable();
            $table->string('nama_pelapor')->nullable();
            $table->string('role_pelapor')->nullable();
            $table->string('email_pelapor')->nullable();
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
        Schema::dropIfExists('laporans');
    }
}
