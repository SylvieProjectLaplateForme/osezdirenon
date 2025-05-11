<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.important nullable  pour les anciennes pubs 


     */
    public function up()
{
    Schema::table('publicites', function (Blueprint $table) {
        $table->date('valid_until')->nullable()->after('created_at');
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicites', function (Blueprint $table) {
            //
        });
    }
};
