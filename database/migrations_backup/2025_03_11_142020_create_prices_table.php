<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->decimal('price', 10, 2);
            $table->string('purchase_url');
            $table->foreignId('retailer_id')->constrained()->onDelete('cascade');
            $table->morphs('component'); // Adds component_id and component_type for polymorphic relationship
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prices');
    }
}