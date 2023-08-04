<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Validator;

/**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */

class UserController extends Controller
{
    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                'email' => 'email|required',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'The given data was invalid.',
                    'data' => $validator->errors()
                ], 422);
            }

            $credentials = request(['email', 'password']);
            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'message' => 'Account is not found.',
                ], 404);
            }

            //Jika hash tidak sesuai
            $user = User::where('email', $request->email)->first();
            if (!Hash::check($request->password, $user->password, [])) {
                return response()->json([
                    'message' => 'Invalid credentials',
                ], 401);
            }

            //jika berhasil maka login
            $tokenResult = $user->createToken('authToken')->plainTextToken;
            return response()->json([
                'token' => $tokenResult,
            ], 200);

        } catch (Exception $error) {
            return $this->sendError(
                [
                    'message' => 'Something went wrong',
                    'error' => $error
                ],
                'Login Failed',
            );
        }
    }

    public function show(User $user)
    {
        try {
            $user = Auth::user($user);
            return response()->json([
                'success' => true,
                'data' => $user,
            ], 200);
        } catch (Exception $error) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthenticated',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $user->tokens()->delete();
        return response()->noContent();
    }

    public function info(){
        $isServerDown = false;

        if ($isServerDown) {
            return response()->json([
                'message' => 'Server is down.'
            ], 502);
        }

        return response()->json([
            'message' => 'Server is running.'
        ], 200);
    }
}
