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
        Schema::table('paiements', function (Blueprint $table) {
           $table->string('payment_method')->nullable()->after('amount'); // ex: card
        $table->string('payment_last4')->nullable()->after('payment_method'); // ex: 4242
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paiements', function (Blueprint $table) {
             $table->dropColumn(['payment_method', 'payment_last4']);
        });
    }
};
