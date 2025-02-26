<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Map;
use Illuminate\Auth\Events\Logout;

class mapController  extends Controller
{
  
    public function index()
    {
        return view('map.index');
    } 

    public function save(Request $request)
    { 
        try {
            // ✅ ตรวจสอบค่าที่รับมาถูกต้องหรือไม่
            $request->validate([
                'fname' => 'required|string',
                'lname' => 'required|string',
                'lat' => 'required|numeric',
                'lng' => 'required|numeric'
            ]);
    
            // ✅ บันทึกลงฐานข้อมูล
            $newposition = new Map();
            $newposition->fname = $request->fname;
            $newposition->lname = $request->lname;
            $newposition->lat = $request->lat;
            $newposition->lng = $request->lng;
            $newposition->save();
    
            return response()->json([
                'message' => '✅ บันทึกตำแหน่งสำเร็จ!',

            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => '❌ เกิดข้อผิดพลาด!',
                'error' => $e->getMessage()
            ], 500);
        }
    } 

    public function show()
    {

            $data['map'] = Map::orderBy('id_user' , 'asc')->paginate(25);

            return view('map.show' , $data);
        
       
    }
    
}






