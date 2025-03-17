<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePowerSuppliesTable extends Migration
{
    public function up()
    {
        Schema::create('power_supplies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('wattage');
            $table->string('form_factor'); // ATX, SFX
            $table->timestamps();
        });
         
    }

    public function down()
    {
        Schema::dropIfExists('power_supplies');
    }
}