<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Handle user login.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            "email" => "required|email|string",
            "password" => "required"
        ]);

        // Attempt to find the user by email
        $user = User::where("email", $request->email)->first();

        if (!empty($user)) {
            // User exists, check the password
            if (Hash::check($request->password, $user->password)) {
                // Password matches, create access token
                $token = $user->createToken("mytoken")->accessToken;

                return response()->json([
                    "status" => true,
                    "message" => "Login Successful",
                    "token" => $token,
                    "data" => []
                ]);
            } else {
                // Password does not match
                return response()->json([
                    "status" => false,
                    "message" => "Password didn't match",
                    "data" => []
                ]);
            }
        } else {
            // User not found with the provided email
            return response()->json([
                "status" => false,
                "message" => "Invalid Email Value",
                "data" => []
            ]);
        }
    }

    /**
     * Handle user logout.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the token associated with the logged-in user
        $token = $request->user()->token();
        $token->revoke();

        return response()->json([
            "status" => true,
            "message" => "User Logged Out Successfully"
        ]);
    }
}