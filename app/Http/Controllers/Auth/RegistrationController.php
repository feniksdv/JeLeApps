<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Services\Auth\RegistrationService;
use Illuminate\Http\JsonResponse;

class RegistrationController extends Controller
{
    private RegistrationService $registrationService;

    public function __construct(
        RegistrationService $registrationService
    ) {
        $this->registrationService = $registrationService;
    }

    public function index(RegistrationRequest $request): JsonResponse
    {
        return $this->getRegistrationService()->register($request);
    }

    private function getRegistrationService(): RegistrationService
    {
        return $this->registrationService;
    }
}
