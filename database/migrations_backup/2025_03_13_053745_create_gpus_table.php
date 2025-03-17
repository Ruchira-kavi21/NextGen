<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGpusTable extends Migration
{
    public function up()
    {
        Schema::create('gpus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('pcie_version');
            $table->integer('power_requirement');
            $table->integer('length'); // Length in mm
            $table->integer('height'); // Height in mm
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gpus');
    }
}