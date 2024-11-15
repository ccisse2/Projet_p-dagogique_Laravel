<?php

namespace App\Actions\Fortify;

use App\Models\Participant;
use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param array<string, mixed> $input
     * @throws ValidationException
     */
    public function update(Participant $user, array $input): void
    {
        Validator::make($input, [
            'nom' => ['required', 'string', 'max:255'],
            'prenom' => ['required','string','max:255'],
            'telephone' => ['required','string','max:255', Rule::unique('participants')->ignore($user->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('participants')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'nom' => $input['nom'],
                'prenom' => $input['prenom'],
                'telephone' => $input['telephone'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(Participant $user, array $input): void
    {
        $user->forceFill([
            'nom' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
