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
        Schema::table('encadrants', function (Blueprint $table) {
        $table->date('date_limite_rapport')->nullable();
        $table->date('date_soutenance')->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('encadrants', function (Blueprint $table) {
            //
        });
    }
};
