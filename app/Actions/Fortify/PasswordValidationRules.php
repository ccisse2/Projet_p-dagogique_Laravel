<?php

namespace App\Actions\Fortify;

use Illuminate\Validation\Rules\Password;

trait PasswordValidationRules
{
 /**
     * Obtenez les règles de validation utilisées pour valider les mots de passe.
     *
     * Cette fonction renvoie un tableau de règles utilisées pour valider les mots de passe dans l'application.
     * Les règles comprennent :
     * - 'obligatoire' : Le champ mot de passe est obligatoire.
     * - 'string' : Le mot de passe doit être une chaîne.
     * - Mot de passe::default() : Le mot de passe doit répondre aux exigences de mot de passe par défaut de Laravel.
     * - 'confirmé' : Le mot de passe doit être confirmé (c'est-à-dire qu'il doit correspondre au champ 'password_confirmation').
     *
     * @return array<int, \Illuminate\Contracts\Validation\Rule|array<mixed>|string>
     * Un tableau de règles de validation.
     */
    protected function passwordRules(): array
    {
        return ['required', 'string', Password::default(), 'confirmed'];
    }
}
