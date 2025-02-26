<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Auth\Events\Logout;

class ShopController  extends Controller
{
  

    public function main()
    {
        return view('shop.main');
    } 
    
}






