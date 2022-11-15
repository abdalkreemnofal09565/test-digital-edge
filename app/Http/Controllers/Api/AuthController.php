<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\PhoneOrEmail;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller
{
    public function register(Request $request){

        $validated = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'identifier' => ['required', 'max:255','unique:users', new PhoneOrEmail],
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);


        $validated['password'] = Hash::make($validated['password']);
        $user = User::create($validated);

        $user->assignRole('User');
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => new UserResource($user),
            'token' => $token  
        ], 200);
    }

    public function login(Request $request){
        $request->validate([
            'identifier' => ['required', 'max:255', new PhoneOrEmail],
            'password' => 'required',
        ]);

        if (!Auth::attempt($request->only(['identifier', 'password']))) {
            return response()->json([
                'message' => __('Credentials not match')
            ], 401);
        }

        $token = Auth::user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => new UserResource(Auth::user()),
            'token' => $token
        ], 200);
    }
    public function changePassword(Request $request){

        $request->validate([
            'current_password' => 'required|min:6',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            
            return response()->json([
                'message' =>"Old Password Doesn't match!"
            ], 401);
        }

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        return response()->json([
            'message' =>'password are changed' 
        ], 200);
    }
    public function logout(){
        Auth::user()->tokens()->delete();

        return response()->json([
            'message' => __('auth.tokens_revoked')
        ], 200);
    }

}
