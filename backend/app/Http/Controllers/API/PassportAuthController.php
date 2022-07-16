<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Validator;

class PassportAuthController extends Controller
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

        $token = $user->createToken('Laravel9PassportAuth')->accessToken;

        return response()->json([
            'data' => [
                'token' => $token
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
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {
            $token = auth()->user()->createToken('Laravel9PassportAuth')->accessToken;

            return response()->json([
                'data' => [
                    'token' => $token
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
     * User info method
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userInfo(): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'data' => auth()->user(),
            'message' => 'User data has been returned with success.',
            'status' => Response::HTTP_OK
        ], Response::HTTP_OK);
    }
}
