<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\ProfileService;
use Illuminate\Http\JsonResponse;

class ProfileController extends Controller
{
    private ProfileService $profileService;

    public function __construct(
        ProfileService $profileService
    ) {
        $this->profileService = $profileService;
    }

    public function index(): JsonResponse
    {
        return $this->getProfileService()->getProfile();
    }

    private function getProfileService(): ProfileService
    {
        return $this->profileService;
    }
}
