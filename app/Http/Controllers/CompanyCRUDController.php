<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Hash; // ✅ เพิ่มการนำเข้า Hash

class CompanyCRUDController extends Controller
{

    public function hashAllPasswords()
    {
        $companies = Company::all();
    
        foreach ($companies as $company) {
            // ✅ ถ้ารหัสผ่านเข้ารหัสแล้ว ข้ามไป
            if (!Hash::needsRehash($company->password)) {
                continue;
            }
    
            // ✅ เข้ารหัสรหัสผ่านใหม่
            $company->password = Hash::make($company->password);
            $company->save();
        }
    
        return "รหัสผ่านทั้งหมดถูกเข้ารหัสเรียบร้อยแล้ว!";
    }
    public function create()
    {
        return view('companies.create');
    } 

    public function store(Request $request)
    { 
        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required',
            'address' => 'required',

        ]);
        
         
        $company = new Company;
        $company->name = $request->name;
        $company->password = Hash::make($request->password);
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        
            return redirect()->route('companies.index')->with('success', 'Company has been created successfully');;
       
    } 

    public function edit(Company $company)
    {
        
            return view('companies.edit' , compact('company'));
        
        
    }

    public function update(Request $request , $id)
    {
        $request->validate([
            'username' => 'required',
            // 'password' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        $company = Company::find($id);
        $company->username = $request->username;
        $company->password = Hash::make($request->password);
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();

        return redirect()->route('companies.index')->with('success', 'Company has been edit successfully');
       
       
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company has been Delete successfully');
    }

    public function index()
    {

            $data['companies'] = Company::orderBy('id' , 'asc')->paginate(5);

          
            return view('companies.index' , $data)->with('success', value: 'loginเเง้ว');
        
       
    }

    


   
 

}






