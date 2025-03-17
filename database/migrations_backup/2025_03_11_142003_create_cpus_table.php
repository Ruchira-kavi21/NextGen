<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCpusTable extends Migration
{
    public function up()
    {
        Schema::create('cpus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('socket_type');
            $table->integer('power_requirement'); // TDP in watts
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cpus');
    }
}