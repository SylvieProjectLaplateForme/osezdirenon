<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // ✅ Supprimer la colonne 'author' si elle existe
            if (Schema::hasColumn('comments', 'author')) {
                $table->dropColumn('author');
            }

            // ✅ Ajouter la contrainte sur user_id (si pas déjà en foreign key)
            if (!Schema::hasColumn('comments', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            } else {
                // Juste ajouter la contrainte si user_id existe déjà
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            }

            // ✅ Ajouter la colonne de modération
            if (!Schema::hasColumn('comments', 'is_approved')) {
                $table->boolean('is_approved')->default(false);
            }
        });
    }

    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            // On remet author
            $table->string('author')->nullable();

            // On retire user_id
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            // On retire is_approved
            $table->dropColumn('is_approved');
        });
    }
};
