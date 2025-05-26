<?php

namespace App\Services\User;

use Illuminate\Http\JsonResponse;

class ProfileService
{
    public function getProfile(): JsonResponse
    {
        $user = auth('sanctum')->user();

        return response()->json([
            'name' => $user->name,
            'email' => $user->email,
            'gender' => $user->profile->gender,
        ], 201);
    }
}
