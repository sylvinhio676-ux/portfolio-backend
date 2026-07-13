<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdatePasswordRequest;
use App\Helpers\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Met à jour le mot de passe de l'administrateur connecté
     *
     * @param UpdatePasswordRequest $request
     * @return JsonResponse
     */
    public function updatePassword(UpdatePasswordRequest $request): JsonResponse
    {
        // Récupère l'admin authentifié via le guard sanctum : le middleware
        // api.auth valide le token sur ce guard, pas sur le guard par défaut
        // (d'où $request->user() qui renvoyait null).
        /** @var \App\Models\User|null $user */
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return ApiResponse::error('Non authentifié', null, 401);
        }

        // Vérifie que le mot de passe actuel est correct
        if (!Hash::check($request->current_password, $user->password)) {
            return ApiResponse::error(
                'Le mot de passe actuel est incorrect',
                ['current_password' => ['Le mot de passe actuel est incorrect']],
                422
            );
        }

        // Enregistre le nouveau mot de passe (hashé automatiquement via le cast du modèle)
        $user->password = Hash::make($request->password);
        $user->save();

        return ApiResponse::message('Mot de passe mis à jour avec succès');
    }
}
