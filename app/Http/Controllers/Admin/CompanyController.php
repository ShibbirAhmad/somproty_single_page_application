<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Company;

class CompanyController extends Controller
{
  public function index(){

        $companies = Company::orderBy('id', 'DESC')->get();
        return response()->json([
            'status' => 'SUCCESS',
            'companies' => $companies
        ]);
  }


  public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies',
        ]);

        $company = new Company();
        $company->name = $request->name;
        if ($company->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "company add successfully"
            ]);
        }
    }

    public function edit($id){

         $company= Company::findOrFail($id);
       return response()->json($company);
       
  }

  public function update(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required|unique:companies,name,'.$id,
        ]);

        $company= Company::findOrFail($id);
        $company->name = $request->name;
        if ($company->save()) {
            return response()->json([
                'status' => 'SUCCESS',
                'message' => "company was updated successfully"
            ]);
        }
    }
}
