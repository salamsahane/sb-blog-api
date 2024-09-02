<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Responses\ApiResponse;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(private UserRepository $userRepository)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userRepository->store($request->validated());

        return ApiResponse::send($user, 'User created successfully');
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $validated = $request->validated();

        $user = $this->userRepository->getUserBy('email', $validated['email']);

        if(!$this->isValidUser($user, $validated['password'])) return ApiResponse::send('', 'The provided credentials are incorrect.', 400);

        return $this->successfulLoginResponse($user);
    }

    private function isValidUser(User $user, string $password): bool
    {
        return $user && Hash::check($password, $user->password);
    }

    private function successfulLoginResponse(User $user): JsonResponse
    {
        $token = $user->createToken('auth_token')->plainTextToken;
        return ApiResponse::send(['access_token' => $token, 'token_type' => 'Bearer']);
    }
}
