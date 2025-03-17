<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMotherboardsTable extends Migration
{
    public function up()
    {
        Schema::create('motherboards', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('socket_type');
            $table->string('ram_type');
            $table->integer('ram_speed');
            $table->string('form_factor'); // ATX, mATX, ITX
            $table->integer('ram_slots'); // Number of RAM slots
            $table->integer('sata_slots'); // Number of SATA ports
            $table->integer('m2_slots'); // Number of M.2 slots
            $table->boolean('m2_nvme_support')->default(false); // Does it support NVMe?
            $table->float('pcie_version');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('motherboards');
    }
}