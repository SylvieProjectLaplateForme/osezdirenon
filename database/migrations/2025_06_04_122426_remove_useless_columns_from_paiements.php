<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_payment_id',
                // 'receipt_url'
            ]);
        });
    }

    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
            $table->string('stripe_payment_id')->nullable();
            // $table->string('receipt_url')->nullable();
        });
    }
};
