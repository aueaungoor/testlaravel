<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Map;
use Illuminate\Auth\Events\Logout;

class mapController  extends Controller
{
  
    protected $except = [
        '/map/realtimee',
    ];
    
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
                'lng' => 'required|numeric',
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

    public function getAllLocations()
{
    $locations = Map::all(); // ดึงข้อมูลทั้งหมดจากฐานข้อมูล
    return response()->json($locations); // ✅ ส่ง JSON กลับไปยัง Frontend
}

public function pagesall()
{
    return view('map.showall' );
}


public function select_mark(Request $request)
{
    $lat['lat'] = $request->lat;
    $lng['lng'] = $request->lng;
    return view('map.select_mark',$lat,$lng );
}

public function realtime()
{
  
    return view('map.realtime ');
}

public function realtimee(Request $request)
    {
        $lat = $request->input('latitude');
        $lng = $request->input('longitude');

        // เช็คว่ามีค่าพิกัดที่ถูกต้องหรือไม่
        if (!$lat || !$lng || !is_numeric($lat) || !is_numeric($lng)) {
            return response()->json(['error' => 'Invalid coordinates'], 400);
        }

        // บันทึกลง Log
        Log::info("📡 ตำแหน่งที่ได้รับ: lat=$lat, lng=$lng");

        // สามารถเพิ่มโค้ดบันทึกลงฐานข้อมูลได้ที่นี่ เช่น
        // Location::create(['latitude' => $lat, 'longitude' => $lng]);

        return response()->json([
            'status' => 'success',
            'latitude' => $lat,
            'longitude' => $lng
        ]);
    }

    public function  addshop()
{
    return view('map.addshop' );
}
}
  











    







