<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends BaseController
{

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function findAllUser(Request $request){
        $users=User::all();
        return $this->sendResponse($users, "Users retrieved Successfully!");
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse(200, 'User is logged out successfully');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'in:admin,user',
        ]);

        // Set default role to 'admin' if not provided in the request
        $userData = array_merge($data, ['role' => $data['role'] ?? 'admin']);


        // Mass assign the validated request data to a new instance of the User model
        $user = User::create($userData);
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'Type' => 'Bearer'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return $this->sendError("Email or Password Incorrect!");

        }

        $token = $user->createToken('my-token')->plainTextToken;

        return $this->sendResponse([
            'token' => $token,
            'role' => $user->role,
            'name'=>$user->name

        ],"User Login Successfully!");
    }
}
