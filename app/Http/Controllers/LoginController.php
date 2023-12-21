<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;


class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    //login
    public function login(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'email_user' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if (!Auth::attempt(['email_user' => $loginData['email_user'], 'password' => $loginData['password']])) {
            return response(['message' => 'Invalid Credentials'], 401);
        }


        /** @var \App\Models\User $user **/
        $user = Auth::user();

        // Check if the user's email is verified
        if ($user->email_verified_at !== null) {
            $token = $user->createToken('Authentication Token')->accessToken;

            return response([
                'message' => 'Authenticated',
                'user' => $user,
                'token_type' => 'Bearer',
                'access_token' => $token,
            ], 200);
        } else {
            // If email is not verified, log the user out and redirect with an error message
            Auth::logout();
            return response([
                'message' => 'Account not verified',
            ], 401);
        }
    }

    //login admin
    public function loginadmin(Request $request)
    {
        $loginData = $request->all();

        $validate = Validator::make($loginData, [
            'email_user' => 'required|email:rfc,dns',
            'password' => 'required',
        ]);

        if ($validate->fails())
            return response(['message' => $validate->errors()], 400);

        if (!Auth::attempt(['email_user' => $loginData['email_user'], 'password' => $loginData['password']])) {
            return response(['message' => 'Invalid Credentials'], 401);
        }


        /** @var \App\Models\User $user **/
        $user = Auth::user();

        // Check if user ada di list admin
        $admin = Admin::where('id_user', $user->id_user)->first();

        if ($admin) {
            $token = $user->createToken('Authentication Token')->accessToken;

            return response([
                'message' => 'Authenticated',
                'user' => $user,
                'token_type' => 'Bearer',
                'access_token' => $token,
            ], 200);
        } else {
            // If email is not verified, log the user out and redirect with an error message
            Auth::logout();
            return response([
                'message' => 'Account Is Not Authorized as Admin',
            ], 401);
        }
    }

    public function logout(Request $request)
    {
        // Revoke the current access token
        $request->user()->token()->revoke();
        return response(['message' => 'Logged out successfully'], 200);
    }
}
