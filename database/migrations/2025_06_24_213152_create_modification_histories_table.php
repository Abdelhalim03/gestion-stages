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
        Schema::create('modification_histories', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('etudiant_id');
    $table->string('type'); // exemple : rapport, présentation
    $table->string('ancien_statut')->nullable();
    $table->string('nouveau_statut');
    $table->text('commentaire')->nullable();
    $table->unsignedBigInteger('updated_by'); // ID de l’encadrant
    $table->timestamps();

    $table->foreign('etudiant_id')->references('id')->on('etudiants')->onDelete('cascade');
    $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modification_histories');
    }
};
