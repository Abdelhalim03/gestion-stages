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
       Schema::table('etudiants', function (Blueprint $table) {
    $table->text('commentaire_rapport')->nullable()->after('statut_rapport');
    $table->text('commentaire_presentation')->nullable()->after('statut_presentation');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('etudiants', function (Blueprint $table) {
    $table->dropColumn('commentaire_rapport');
    $table->dropColumn('commentaire_presentation');
});
    }
};
