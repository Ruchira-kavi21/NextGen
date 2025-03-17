<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update motherboards table
        Schema::table('motherboards', function (Blueprint $table) {
            $table->string('form_factor')->after('ram_speed')->default('ATX'); // Default to 'ATX'
            $table->integer('ram_slots')->after('form_factor')->default(4); // Default to 4 slots
            $table->integer('sata_slots')->after('ram_slots')->default(6); // Default to 6 SATA slots
            $table->integer('m2_slots')->after('sata_slots')->default(2); // Default to 2 M.2 slots
            $table->boolean('m2_nvme_support')->default(false)->after('m2_slots');
        });

        // Update cpus table
        Schema::table('cpus', function (Blueprint $table) {
            $table->integer('power_requirement')->after('socket_type')->default(65); // Default TDP 65W
        });

        // Update rams table
        Schema::table('rams', function (Blueprint $table) {
            $table->integer('stick_count')->after('ram_speed')->default(2); // Default to 2 sticks
        });

        // Update storages table
        Schema::table('storages', function (Blueprint $table) {
            $table->string('type')->after('name')->default('SATA'); // Default to SATA
            $table->boolean('nvme')->default(false)->after('type');
        });

        // Update gpus table
        Schema::table('gpus', function (Blueprint $table) {
            $table->integer('length')->after('power_requirement')->default(200); // Default length 200mm
            $table->integer('height')->after('length')->default(100); // Default height 100mm
        });

        // Update power_supplies table
        Schema::table('power_supplies', function (Blueprint $table) {
            $table->string('form_factor')->after('wattage')->default('ATX'); // Default to ATX
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motherboards', function (Blueprint $table) {
            $table->dropColumn(['form_factor', 'ram_slots', 'sata_slots', 'm2_slots', 'm2_nvme_support']);
        });

        Schema::table('cpus', function (Blueprint $table) {
            $table->dropColumn('power_requirement');
        });

        Schema::table('rams', function (Blueprint $table) {
            $table->dropColumn('stick_count');
        });

        Schema::table('storages', function (Blueprint $table) {
            $table->dropColumn(['type', 'nvme']);
        });

        Schema::table('gpus', function (Blueprint $table) {
            $table->dropColumn(['length', 'height']);
        });

        Schema::table('power_supplies', function (Blueprint $table) {
            $table->dropColumn('form_factor');
        });
    }
};