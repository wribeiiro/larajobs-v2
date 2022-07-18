<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class SanctumAuthController extends Controller
{
    /**
     * Register method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $userValidator = Validator::make($request->all(), [
            'name' => 'required|min:4',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ]);

        if ($userValidator->fails()){
            return response()->json([
                'data' => null,
                'message' => $userValidator->errors(),
                'status' => Response::HTTP_UNPROCESSABLE_ENTITY
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'data' => [
                'user' => $user,
                'token' => $user->createToken('Larajobs')->plainTextToken
            ],
            'message' => 'User was created with success.',
            'status' => Response::HTTP_CREATED
        ], Response::HTTP_CREATED);
    }

    /**
     * Login method
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            return response()->json([
                'data' => [
                    'user' => Auth::user(),
                    'token' => Auth::user()->createToken('Larajobs')->accessToken
                ],
                'message' => 'Login has been done with success.',
                'status' => Response::HTTP_OK
            ], Response::HTTP_OK);
        }

        return response()->json([
            'error' => 'Unauthorised'
        ], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Logou user
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request): \Illuminate\Http\JsonResponse
    {
        // Revoke the token that was used to authenticate the current request...
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'error' => 'User and token was disconnected'
        ], Response::HTTP_OK);
    }

    /**
     * User info method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => Auth::user(),
            'message' => 'User data has been returned with success.',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
