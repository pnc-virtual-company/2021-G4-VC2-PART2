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
            'email' => 'required|email',
            'firstName' => 'required',
            'lastName' => 'required',
            'role' => 'required',
            'batch' => 'nullable',
            'userImage' => 'nullable',
            'isComplete' => 'required',
        ]);

        // $img = 'data:image/png;base64,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';

        // create User
        $user = new User();
        $user->firstName = $request->firstName;
        $user->lastName = $request->lastName;
        $user->role = $request->role;
        $user->batch = $request->batch;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->isComplete = $request->isComplete;
        // $user->userImage = $img;

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
            return response()->json(['message' => 'Email or Password is invalid'], 401);
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
        // return User::select('company_details.*', 'user_details.*', 'users.*', 'companies.*')->join('company_details', 'users.id', '=', 'company_details.user_id')->join('user_details', 'user_details.user_id', '=', 'users.id')->join('companies', 'companies.user_id', '=', 'users.id')->get();
    }

    function search($name)
    {
        $result = User::where('firstName', 'LIKE', '%'. $name. '%')->join('user_details', 'user_details.user_id', '=', 'users.id')->join('companies', 'companies.user_id', '=', 'user_details.user_id')->join('company_details', 'company_details.user_id', '=', 'companies.user_id')->get();

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
     * Update the specified image in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateImage(Request $request, $id)
    {
        $request->validate([
            'userImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,jfif|max:1999',
        ]);

        // create User
        $user =  User::findOrFail($id);

        if($request->file('userImage')!=''){
            $path = public_path()."/storage/images/users/";
            $file = $request->userImage;
            $fileName = $file->getClientOriginalName();
            if($user->userImage!='' && $user->userImage!= null && $user->userImage!=[]){
                $oldImg = $path.$user->userImage;
                unlink($oldImg);
                $user->userImage = $fileName;
            }
            else{
                $user->userImage = $fileName;
            }
            
            $file->move($path,$fileName);
            $user->update(['userImage'=>$fileName]);
            $user->save();
            return response()->json([
                'user' => $user,
                'message' => 'Update Image successfully',
            ]);

        }
        else{
            $user->userImage = $request->file();
            $user->save();
        }
        
        
        return response()->json([
            'user' => $user,
            'message' => 'Image not found',
        ]);
    }

    public function verifyUserComplet(Request $request, $id)
    {
        $user =  User::findOrFail($id);
        $user->isComplete = $request->isComplete;
        $user->save();
        
        
        return response()->json([
            'user' => $user,
            'message' => 'You are completed',
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
