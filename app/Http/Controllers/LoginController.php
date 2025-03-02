<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Auth\Events\Logout;

class LoginController  extends Controller
{
    public function login(Request $request)
    { 

        $credentials = $request->only('name', 'password','role');
        $selectedRole = $request->input('role');
        
        // $credentials = $request->validate([
        //     'username' => 'required',
        //     'password' => 'required',
        //     'role' => 'required',
        // ]);

    
        // 🔹 ใช้ Auth::attempt() เพื่อตรวจสอบข้อมูลล็อกอิน
        if (Auth::attempt($credentials)) {
            // 🔹 ล็อกอินสำเร็จ Redirect ไปที่หน้า companies.index\
            // if($selectedRole == 'chef')
            // {
            //     return redirect()->route('chef.main')->with('success', 'Login Success');
            // }
            // else if($selectedRole == 'shop')
            // {
            //     return redirect()->route('shop.main')->with('success', 'Login Success');
            // }
            // else{
            //     return redirect()->route('companies.index')->with('success', 'Login Success');
            // }

            return redirect()->route('companies.index')->with('success', 'Login Success');
           
        }
    
        // 🔹 ถ้าล็อกอินไม่สำเร็จ กลับไปที่หน้า Login พร้อมแสดงข้อความแจ้งเตือน
        return back()->withErrors(['username' => 'Username หรือ Password หรือ คุณไม่มีrole ไม่ถูกต้อง'])->withInput();
    } 

    public function form_login()
    {
        return view('form_login')->with('success' ,'login dsafsdfasdf');
    }

    public function logout()
    {
        auth()->logout();
        return redirect('/'); 
    }


    public function register()
    {
        
    }


    
    
}






