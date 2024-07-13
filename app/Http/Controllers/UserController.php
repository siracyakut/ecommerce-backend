<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(UserLoginRequest $request)
    {
        try {
            $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]);
            $user = auth()->user();

            if (!$token) return response()->json([
                'success' => false,
                'data' => 'Invalid email or password'
            ]);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 201)->cookie('token', $token, 5256000, '/', null, true, true, false, 'none');
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function register(UserRegisterRequest $request)
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'surname' => $request->surname,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $token = auth()->attempt(['email' => $request->email, 'password' => $request->password]);

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 201)->cookie('token', $token, 5256000, '/', null, true, true, false, 'none');
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function logout()
    {
        try {
            auth()->logout();

            return response()->json([
                'success' => true,
                'data' => 'Logged out successfully.'
            ], 200)->cookie('token', '', -1);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function check(Request $request)
    {
        try {
            $user = auth()->user();
            $token = $request->cookie('token');

            return response()->json([
                'success' => true,
                'data' => [
                    'user' => $user,
                    'token' => $token
                ]
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function update(UserUpdateRequest $request)
    {
        try {
            $user_id = auth()->user()->id;
            $user = User::find($user_id);

            if (isset($request->telephone)) {
                $user->telephone = $request->telephone;
            } else {
                $compare = Hash::check($request->passForConfirm, $user->password);

                if (!$compare) return response()->json([
                    'success' => false,
                    'data' => 'Invalid password'
                ], 401);

                if (isset($request->email)) {
                    $user->email = $request->email;
                }

                if (isset($request->newPass) && isset($request->newPassConfirm)) {
                    $user->password = Hash::make($request->newPass);
                }
            }

            $user->save();

            return response()->json([
                'success' => true,
                'data' => $user
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'data' => $e->getMessage()
            ], 500);
        }
    }
}
