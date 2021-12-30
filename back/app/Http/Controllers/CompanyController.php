<?php

namespace App\Http\Controllers;
use App\Models\Company;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Company::all();
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
            'companyName' => 'required|unique:companies|min:5',
            'companyImage' => 'required|image|mimes:jpg,jpeg,png|max:1999'
        ]);
        $request->file('companyImage')->store('/public/images/companies/');
        
        $com = new Company();

        if(Company::where('companyName',$request->companyName)->exists()){
            return response()->json(['message'=>'exist']);
        }
        else{
            $com->user_id = $request->user_id;
            $com->companyName = $request->companyName;
            $com->companyImage = $request->companyImage;
            $com->companyImage = $request->file('companyImage')->hashName();
            $com->save();

            return response()->json([ 'message'=>'Company created successfully!'],201);
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
        // return Company::findOrfail($id);
        return Company::select('companies.*')->where('user_id', $id)->get();
        // return Company::join('user_details', 'companies.id', '=', 'user_details.company_id')->get('companies.*', 'user_details.company_id');
    }

    
    public function search($name)
    {
        $result = Company::where('companyName', 'LIKE', '%'. $name. '%')->get();
        if (count($result)){
            return Response()->json($result);
        } else {
            return response()->json(['Result' => 'Data not found'], 404);
        }
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
            'companyName' => 'required|unique',
            'companyImage' => 'required'
        ]);

        $com = Company::findOrFail($id);

        $com->user_id = $request->user_id;
        $com->companyName = $request->companyName;
        $com->companyImage = $request->companyImage;

        $com->save();

        return response()->json([ 'message'=>'Company updated successfully!'], 200);
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
            'companyImage' => 'nullable|image|mimes:jpg,jpeg,png,gif,jfif|max:1999',
        ]);

        // create Company
        $com =  Company::findOrFail($id);

        // store image
        $com->companyImage = $request->file('companyImage')->hashName();
        $request->file('companyImage')->store('public/images/companies');

        $com->save();

        return response()->json([
            'company' => $com,
            'message' => 'Company Image Updated',
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
        $com = Company::destroy($id);
       
        if ($com === 1) {
            return response()->json(['message' => 'deleted successfully'], 200);
        } else {
            return response()->json(['message' => 'Cannot deleted no id'], 404);
        }
    }
}
