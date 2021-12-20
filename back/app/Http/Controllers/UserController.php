<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Signup________________________
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

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

        // Create Token
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'message' => 'User Created',
            'token' => $token,
        ]);
    }

    // Logout___________________
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();
        return response()->json(['message' => 'User logged out']);
    }

    // Login____________________
    public function login(Request $request){
        // Check email
        $user = User::where('email',$request->email)->first();

        // Check password
        if (!$user || !Hash::check($request->password, $user->password)){
            return response()->json(['message' => 'Incorrect Email or Password'], 401);
        }

        // Create Token
        $token = $user->createToken('mytoken')->plainTextToken;

        return response()->json([
            'user' => $user,
            'message' => 'Login successful',
            'token' => $token,
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
    }

    function search($name)
    {
        $result = User::where('firstName', 'LIKE', '%'. $name. '%')->get();
        if(count($result)){
         return Response()->json($result);
        }
        else
        {
        return response()->json(['Result' => 'No Data not found'], 404);
      }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return User::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|confirmed',
            'email' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            'role' => 'required',
        ]);

        // create User
        $user =  User::findOrFail($id);
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);

        $user->save();

        return response()->json([
            'user' => $user,
            'message' => 'User Updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::destroy($id);
       
        if ($user === 1) {
            return response()->json(['message' => 'deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Cannot deleted no id'], 404);
        }
    }
}
