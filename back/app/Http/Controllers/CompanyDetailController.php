<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Models\CompanyDetail;

class CompanyDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CompanyDetail::latest()->get();
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
            'user_id' => 'required',
            'company_id' => 'required',
            'alumniPosition' => 'required',
            'companyHR' => 'required',
            'companyWebsite' => 'required',
            'companyEmail' => 'required',
            'companyContact' => 'required',
            'companyLocation' => 'required'
        ]);


        $com_detail = new CompanyDetail;

        $com_detail->user_id = $request->user_id;
        $com_detail->company_id = $request->company_id;
        $com_detail->alumniPosition = $request->alumniPosition;
        $com_detail->companyHR = $request->companyHR;
        $com_detail->companyWebsite = $request->companyWebsite;
        $com_detail->companyEmail = $request->companyEmail;
        $com_detail->companyContact = $request->companyContact;
        $com_detail->companyLocation = $request->companyLocation;

        $com_detail->save();

        return response()->json([
            'message' => 'company detail created !',
            'data' => $com_detail
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return CompanyDetail::findOrFail($id);
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
            'user_id' => 'required',
            'company_id' => 'required',
            'alumniPosition' => 'required',
            'companyHR' => 'required',
            'companyWebsite' => 'required',
            'companyEmail' => 'required',
            'companyContact' => 'required',
            'companyLocation' => 'required'
        ]);


        $com_detail = CompanyDetail::findOrFail($id);

        $com_detail->user_id = $request->user_id;
        $com_detail->company_id = $request->company_id;
        $com_detail->alumniPosition = $request->alumniPosition;
        $com_detail->companyHR = $request->companyHR;
        $com_detail->companyWebsite = $request->companyWebsite;
        $com_detail->companyEmail = $request->companyEmail;
        $com_detail->companyContact = $request->companyContact;
        $com_detail->companyLocation = $request->companyLocation;

        $com_detail->save();

        return response()->json([
            'message' => 'company detail updated !',
            'data' => $com_detail
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = CompanyDetail::destroy($id);

        if ($isDeleted = 1){
            return response()->json([
                'message' => 'company detail deleted successfully !'
            ]);
        } else {
            return response()->json([
                'message' => 'no company detail found !'
            ]);
        }
    }
}
