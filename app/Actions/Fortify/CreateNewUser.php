<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;

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

        // Creando validaciones con Fortify 
        Validator::make($input, [
            'name' => ['required', 'string', 'max:20'],
            'username' => ['required','unique:users', 'min:3', 'max:20'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),['confirmed']
        ])->validate();

        // Insertar Datos
            // La variable input hace alucion a nuestra "Request"
        return User::create([
            'name' => $input['name'],
            'username' => Str::slug($input['username']), // Agregamos campo de username nos arroga un error
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

    }
}
