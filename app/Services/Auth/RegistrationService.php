<?php

namespace App\Services\Auth;


use App\Http\Requests\Auth\RegistrationRequest;
use App\Repositories\PersonalAccessTokenRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\UserRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class RegistrationService
{
    private UserRepository $userRepository;
    private PersonalAccessTokenRepository $personalAccessTokenRepository;
    private ProfileRepository $profileRepository;

    public function __construct(
        UserRepository $userRepository,
        PersonalAccessTokenRepository $personalAccessTokenRepository,
        ProfileRepository $profileRepository,
    ) {
        $this->userRepository = $userRepository;
        $this->personalAccessTokenRepository = $personalAccessTokenRepository;
        $this->profileRepository = $profileRepository;
    }

    public function register(RegistrationRequest $request): JsonResponse
    {
        DB::beginTransaction();

        try {
            $user = $this->getUserRepository()->create($request);
            $this->getProfileRepository()->create($user, $request);
            $token = $this->getPersonalAccessTokenRepository()->create($user);

            DB::commit();

            return response()->json([
                'user' => $user,
                'token' => $token,
            ], 201);

        } catch (QueryException $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Registration failed',
                'error' => $e->getMessage()
            ], 500);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'An error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    private function getUserRepository(): UserRepository
    {
        return $this->userRepository;
    }

    private function getPersonalAccessTokenRepository(): PersonalAccessTokenRepository
    {
        return $this->personalAccessTokenRepository;
    }

    private function getProfileRepository(): ProfileRepository
    {
        return $this->profileRepository;
    }
}
