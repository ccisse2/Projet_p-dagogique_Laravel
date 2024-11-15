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
        Schema::table('sorties', function (Blueprint $table) {
            Schema::table('sorties', function (Blueprint $table) {
                $table->dateTime('dateHeureDebut')->change();
                $table->dateTime('dateLimiteInscription')->change();
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sorties', function (Blueprint $table) {
            Schema::table('sorties', function (Blueprint $table) {
                $table->date('dateHeureDebut')->change();
                $table->date('dateLimiteInscription')->change();
            });
        });
    }
};
