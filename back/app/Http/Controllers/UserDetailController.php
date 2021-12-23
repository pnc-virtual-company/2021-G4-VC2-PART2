<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDetail;

class UserDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserDetail::with(['user','company'])->latest()->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gender' => 'nullable',
            'DOB' => 'nullable',
            'batch' => 'nullable',
            'major' => 'nullable',
            'skill' => 'nullable',
            'city' => 'nullable',
            'maritalStatus' => 'nullable',
        ]);

        $userDetail = new UserDetail();
        $userDetail->user_id = $request->user_id;
        $userDetail->company_id = $request->company_id;
        $userDetail->gender = $request->gender;
        $userDetail->DOB = $request->DOB;
        $userDetail->batch = $request->batch;
        $userDetail->major = $request->major;
        $userDetail->skill = $request->skill;
        $userDetail->city = $request->city;
        $userDetail->maritalStatus = $request->maritalStatus;
        $userDetail->phoneNumber = $request->phoneNumber;
        $userDetail->save();

        return response()->json([ 'message'=>'User Detail created successfully!'],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return UserDetail::findOrFail($id);
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
            'gender' => 'nullable',
            'DOB' => 'nullable',
            'batch' => 'nullable',
            'major' => 'nullable',
            'skill' => 'nullable',
            'city' => 'nullable',
            'maritalStatus' => 'nullable',
        ]);

        $userDetail = UserDetail::findOrFail($id);
        $userDetail->user_id = $request->user_id;
        $userDetail->company_id = $request->company_id;
        $userDetail->gender = $request->gender;
        $userDetail->DOB = $request->DOB;
        $userDetail->batch = $request->batch;
        $userDetail->major = $request->major;
        $userDetail->skill = $request->skill;
        $userDetail->city = $request->city;
        $userDetail->maritalStatus = $request->maritalStatus;
        $userDetail->save();

        return response()->json([ 'message'=>'User Detail updated successfully!'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userDetail = UserDetail::destroy($id);
       
        if ($userDetail === 1) {
            return response()->json(['message' => 'deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Cannot deleted no id'], 404);
        }
    }
}
