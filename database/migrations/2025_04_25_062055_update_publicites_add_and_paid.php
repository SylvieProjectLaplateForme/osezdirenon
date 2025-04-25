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
        
{
    Schema::table('publicites', function (Blueprint $table) {
        // $table->boolean('is_approved')->default(false);
        $table->boolean('paid')->default(false);
        // $table->boolean('is_active')->default(false);
    });
}

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
        
            Schema::table('publicites', function (Blueprint $table) {
                // $table->dropColumn('is_approved');
                $table->dropColumn('paid');
                // facultatif : si tu veux aussi enlever is_active, décommente la ligne suivante :
                // $table->dropColumn('is_active');
            });
    }
};
