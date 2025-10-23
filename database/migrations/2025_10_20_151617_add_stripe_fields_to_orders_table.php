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
            $table->string('payment_method')->nullable()->after('status'); // stripe, cash, etc.
            $table->string('payment_id')->nullable()->after('payment_method'); // Stripe Payment Intent ID
            $table->string('payment_status')->default('pending')->after('payment_id'); // pending, paid, failed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_id', 'payment_status']);
        });
    }
};
