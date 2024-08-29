<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $response = $this->authService->register($request->validated());

        return response()->json($response);
    }

    public function login(LoginRequest $request)
    {
        $response = $this->authService->login($request->validated());

        if (isset($response['error'])) {
            return response()->json(['message' => $response['error']], 401);
        }

        return response()->json($response);
    }
}
