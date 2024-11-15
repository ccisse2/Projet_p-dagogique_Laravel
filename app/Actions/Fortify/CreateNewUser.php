<?php

namespace App\Actions\Fortify;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): Participant
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:50'],
            'prenom' => ['required','string','max:50'],
            'telephone' => ['required','string','max:20'],
            'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            'campus_id' => ['required', 'exists:campuses,id'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return Participant::create([
            'nom' => $input['nom'],
            'prenom' => $input['prenom'],
            'telephone' => $input['telephone'],
            'email' => $input['email'],
            'campus_id' => $input['campus_id'],
            'motPasse' => Hash::make($input['password']),
        ]);
    }
}
