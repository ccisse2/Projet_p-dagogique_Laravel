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
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('telephone');
            $table->string('email', 191)->unique();
            $table->string('motPasse');
            $table->boolean('administrateur');
            $table->boolean('actif');
            $table->foreignId('campus_id')->constrained('campus')->onDelete('cascade');
            $table->timestamp('email_verified_at')->nullable(); // Date de vérification de l'email
            $table->string('remember_token', 100)->nullable(); // Token de "Se souvenir de moi"
            $table->text('two_factor_secret')->nullable(); // Secret pour l'authentification 2FA
            $table->text('two_factor_recovery_codes')->nullable(); // Codes de récupération pour 2FA
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('participants');
    }
};
