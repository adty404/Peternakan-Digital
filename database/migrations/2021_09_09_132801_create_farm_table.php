<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('office_id');
            $table->string('name');
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->string('pic');
            $table->string('logo')->nullable();
            $table->string('qrcode')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('farm');
    }
}
