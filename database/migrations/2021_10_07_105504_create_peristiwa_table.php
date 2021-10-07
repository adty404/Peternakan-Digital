<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeristiwaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peristiwa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('animal_id');
            $table->string('tanggal');
            $table->string('waktu');
            $table->string('peristiwa');
            $table->string('keterangan');
            $table->string('foto');
            $table->string('created_by');
            $table->string('updated_by');
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
        Schema::dropIfExists('peristiwa');
    }
}
