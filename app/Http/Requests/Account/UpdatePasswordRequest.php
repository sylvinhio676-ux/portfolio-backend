<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePasswordRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Mot de passe actuel (vérifié dans le contrôleur via Hash::check)
            'current_password' => ['required', 'string'],
            // Nouveau mot de passe (champ password_confirmation attendu)
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }
}
