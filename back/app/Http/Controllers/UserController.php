<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function signup(Request $request){
        $request->validate([
            'password' => 'required|confirmed',
            'email' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'role' => 'required',
        ]);

        // create User
        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'user' => $user,
            'message' => 'User Created'
        ]);
    }
    public function logout(Request $request)
    {
        return response()->json(['message' => 'User logged out']);
    }
 
    public function login(Request $request){
        // Check email
        $user = User::where('email',$request->email)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Bad login'], 401);
        }

        return response()->json([
            'user' => $user,
            'message' => 'Login successful'
        ]);
    }
}
