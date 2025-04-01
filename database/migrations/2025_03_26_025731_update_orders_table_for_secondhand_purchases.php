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
        Schema::table('orders', function (Blueprint $table) {
            $table->unsignedBigInteger('part_id')->after('customer_id');
            $table->foreign('part_id')->references('id')->on('second_hand_parts')->onDelete('cascade');
            
            $table->string('first_name')->after('part_id');
            $table->string('last_name')->after('first_name');
            $table->string('email')->after('last_name');
            $table->string('phone_number')->nullable()->after('email');
            
            $table->string('country')->after('phone_number');
            $table->string('province')->after('country');
            $table->string('district')->after('province');
            $table->string('zipcode')->nullable()->after('district');
            
            $table->string('payment_option')->after('zipcode');
            $table->string('stripe_payment_id')->nullable()->after('payment_option');
            $table->decimal('component_price', 10, 2)->after('stripe_payment_id');
            $table->boolean('verify_product')->after('component_price');
            $table->decimal('verify_cost', 10, 2)->after('verify_product');
            $table->decimal('shipping_charges', 10, 2)->after('verify_cost');
            
            $table->string('shipping_address')->nullable()->change(); 
            $table->decimal('total', 10, 2)->change(); 
            $table->enum('status', ['Pending', 'Completed', 'Cancelled'])->change(); 
            $table->enum('payment_status', ['Pending', 'Paid', 'Failed'])->default('Pending')->change(); 
            $table->timestamp('order_date')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign(['part_id']);
            $table->dropColumn([
                'part_id',
                'first_name',
                'last_name',
                'email',
                'phone_number',
                'country',
                'province',
                'district',
                'zipcode',
                'payment_option',
                'stripe_payment_id',
                'component_price',
                'verify_product',
                'verify_cost',
                'shipping_charges',
            ]);
        });
    }
};