<?php

namespace App\Repositories;

use App\Http\Requests\Auth\RegistrationRequest;
use App\Models\Profile;
use App\Models\User;

class ProfileRepository
{
    private Profile $profile;

    public function __construct(
        Profile $profile
    ) {
        $this->profile = $profile;
    }

    public function create(User $user, RegistrationRequest $request)
    {
        return $this->getProfileModel()->create([
            'user_id' => $user->id,
            'gender' => $request['gender'],
        ]);
    }

    private function getProfileModel(): Profile
    {
        return $this->profile;
    }
}
