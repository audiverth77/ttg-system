<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Spatie\Permission\Models\Role;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name_company' => ['required_if:role,empleador', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'phone' => ['required', 'string', 'max:255'],
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'cv' => ['file', 'mimes:pdf', 'max:2048'],
            'profile_photo_path' => ['image', 'max:2048'],
            'role' => ['required', 'string', 'in:empleador,candidato'],
        ])->validate();

        $request = request();

        if ($request->hasFile('profile_photo_path') && $request->file('profile_photo_path')->isValid()) {
            $fotoPath = $request->foto->store('fotos', 'public');
        }

        if ($request->hasFile('cv') && $request->file('cv')->isValid()) {
            $cvPath = $request->cv->store('cvs', 'public');
        }
        
        $user = User::create([
            'name_company' => $input['name_company'] ?? null,
            'address' => $input['address'],
            'name' => $input['name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'phone' => $input['phone'],
            'cv' => $cvPath ?? null,
            'profile_photo_path' =>  $fotoPath ?? null,

        ]);

        $user->assignRole($input['role']);

        return $user;
    }
}
