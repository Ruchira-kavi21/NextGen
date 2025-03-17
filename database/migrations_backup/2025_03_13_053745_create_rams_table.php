<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRamsTable extends Migration
{
    public function up()
    {
        Schema::create('rams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('ram_type');
            $table->integer('ram_speed');
            $table->integer('stick_count'); // Number of sticks in the kit
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('rams');
    }
}