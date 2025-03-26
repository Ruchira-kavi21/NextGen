<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('second_hand_parts', function (Blueprint $table) {
            // Add seller_id column only if it doesn't exist
            if (!Schema::hasColumn('second_hand_parts', 'seller_id')) {
                $table->unsignedBigInteger('seller_id')->nullable()->after('id');
                $table->foreign('seller_id')->references('id')->on('users')->onDelete('set null');
            }

            // Update status column to include Pending and Declined
            $table->enum('status', ['Pending', 'Available', 'Sold', 'Declined'])->default('Pending')->change();
        });
    }

    public function down(): void
    {
        Schema::table('second_hand_parts', function (Blueprint $table) {
            // Drop the foreign key and seller_id column if they exist
            if (Schema::hasColumn('second_hand_parts', 'seller_id')) {
                $table->dropForeign(['seller_id']);
                $table->dropColumn('seller_id');
            }

            // Revert status column to original values
            $table->enum('status', ['Available', 'Sold'])->default('Available')->change();
        });
    }
};