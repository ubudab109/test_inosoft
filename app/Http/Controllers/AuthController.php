<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    protected AuthService $authService;

    /**
     * The constructor function is called when the class is instantiated. It takes the AuthService
     * class as a parameter and assigns it to the authService property
     * 
     * @param AuthService authService This is the service that will be injected into the constructor.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * > The login function accepts an AuthRequest object, calls the auth method on the AuthService
     * object, and returns a JsonResponse object
     * 
     * @param AuthRequest request The request object
     * 
     * @return JsonResponse A JsonResponse object.
     */
    public function login(AuthRequest $request) : JsonResponse
    {
        $auth = $this->authService->auth($request->all());
        return response()->json($auth, Response::HTTP_OK);
    }
}
