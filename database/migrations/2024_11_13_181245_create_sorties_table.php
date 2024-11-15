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
        Schema::create('sorties', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->date('dateHeureDebut');
            $table->integer('duree');
            $table->date('dateLimiteInscription');
            $table->integer('nbInscriptionsMax');
            $table->text('infosSortie');
            $table->foreignId('etat_id')->constrained('etats');
            $table->foreignId('lieu_id')->constrained('lieus')->onDelete('cascade');
            $table->foreignId('campus_id')->constrained('campus')->onDelete('cascade');
            $table->foreignId('organisateur_id')->constrained('participants')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sorties');
    }
};
