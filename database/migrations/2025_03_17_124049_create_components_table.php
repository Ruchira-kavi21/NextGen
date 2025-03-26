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
        Schema::create('components', function (Blueprint $table) {
            $table->id();
            $table->string('component_name');
            $table->string('category');
            $table->decimal('price', 10, 2);
            $table->integer('stock');
            $table->string('brand')->nullable(); // New column: brand
            $table->string('model_number')->nullable(); // New column: model number
            $table->text('description')->nullable(); // New column: description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('components');
    }
};
