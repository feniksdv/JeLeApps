<?php

namespace App\Repositories;

use App\Models\PersonalAccessToken;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class PersonalAccessTokenRepository
{
    private PersonalAccessToken $PersonalAccessToken;

    public function __construct(
        PersonalAccessToken $PersonalAccessToken
    ) {
        $this->personalAccessToken = $PersonalAccessToken;
    }

    public function create(User $user): string
    {
        return $user->createToken('auth-token')->plainTextToken;
    }

    private function getPersonalAccessTokenModel(): PersonalAccessToken
    {
        return $this->personalAccessToken;
    }
}
