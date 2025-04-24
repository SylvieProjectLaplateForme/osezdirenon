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
    Schema::create('publicites', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->text('contenu')->nullable(); // ou image
        $table->string('image')->nullable();
        $table->string('lien'); // lien cliquable
        $table->boolean('is_active')->default(false);
        $table->boolean('is_approved')->default(false); // ✅ ajout pour modération
        $table->timestamp('date_debut')->nullable();
        $table->timestamp('date_fin')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publicites');
    }
};
