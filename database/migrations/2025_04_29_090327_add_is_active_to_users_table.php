<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('users', function (Blueprint $table) {
        $table->boolean('is_active')->default(1); // Ajoute une colonne is_active avec valeur par défaut = actif
    });
}

public function down()
{
    Schema::table('users', function (Blueprint $table) {
        $table->dropColumn('is_active');
    });
}
};
